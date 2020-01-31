<?php

namespace Christophrumpel\LaravelCommandFilePicker;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use ReflectionClass;
use Symfony\Component\Finder\SplFileInfo;

class FileFinder
{

    /** @var Filesystem */
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getFilesInDirectory(string $directory): Collection
    {
        $files = $this->filesystem->files($directory);

        return collect($files)
            ->map(function (SplFileInfo $file) {

                return [
                    'path' => $file->getPathname(),
                    'link' => vsprintf('<href=file://%s>%s</>', [
                        $file->getPathname(),
                        $file->getPathname(),
                    ]),
                ];
            })
            ->sort();
    }
}
