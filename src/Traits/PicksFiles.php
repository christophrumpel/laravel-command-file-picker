<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\FileFinder;

trait PicksFiles
{

    protected function askToPickFiles($path): string
    {
        $finder = new FileFinder($this->laravel->make('files'));
        $classNames = $finder->getFilesInDirectory($path);

        if ($classNames->isEmpty()) {
            throw new \LogicException('No files found to show.');
        }

        return $this->choice('Please pick a file', $classNames->toArray());
    }
}
