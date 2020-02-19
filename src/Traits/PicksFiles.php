<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\FileFinder;

trait PicksFiles
{

    protected function askToPickFiles(string $path, callable $filter = null): string
    {
        $finder = new FileFinder($this->laravel->make('files'));
        $files = $finder->getFilesInDirectory($path)
            ->filter($filter)->values();

        if ($files->isEmpty()) {
            throw new \LogicException('No files found to show.');
        }

        $linkedModels = collect($files)
            ->transform(function (array $file) {
                return $file['link'];
            })
            ->toArray();

        $chosenClass = $this->choice('Please pick a file', $linkedModels);

        return $files->filter(function($class) use ($chosenClass) {
            return $class['link'] === $chosenClass;
        })->first()['path'];

    }
}
