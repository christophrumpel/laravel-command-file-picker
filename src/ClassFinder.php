<?php

namespace Christophrumpel\LaravelCommandFilePicker;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use ReflectionClass;
use SplFileInfo;

class ClassFinder
{

    /** @var Filesystem */
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getClassesInDirectory(string $directory, bool $lookingForModels = false): Collection
    {
        $files = $this->filesystem->files($directory);

        return Collection::make($files)->filter(function (SplFileInfo $file) {
            return $file->getExtension() === 'php';
        })->map(function (SplFileInfo $file) {
            $path = $file->getPathname();

            return [$path, $this->getFullyQualifiedClassNameFromFile($path)];
        })->filter(function (array $tuple) {
            [, $className] = $tuple;

            return ! empty($className);
        })->filter(function (array $tuple) use ($lookingForModels) {
            [, $className] = $tuple;

            if ($lookingForModels) {
                return is_subclass_of($className,
                        EloquentModel::class) && ! (new ReflectionClass($className))->isAbstract();
            }

            return true;
        })->transform(function (array $tuple) {
            return vsprintf('<href=file://%s>%s</>', $tuple);
        })->sort();
    }

    public function getModelsInDirectory(string $directory): Collection
    {
        return $this->getClassesInDirectory($directory, true);
    }

    protected function getFullyQualifiedClassNameFromFile(string $path): string
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

        $traverser = new NodeTraverser();
        $traverser->addVisitor(new NameResolver());

        $code = file_get_contents($path);

        $statements = $parser->parse($code);
        $statements = $traverser->traverse($statements);

        // get the first namespace declaration in the file
        $root_statement = collect($statements)->first(function ($statement) {
            return $statement instanceof Namespace_;
        });

        if ( ! $root_statement) {
            return '';
        }

        return collect($root_statement->stmts)->filter(function ($statement) {
                return $statement instanceof Class_;
            })->map(function (Class_ $statement) {
                return $statement->namespacedName->toString();
            })->first() ?? '';
    }
}
