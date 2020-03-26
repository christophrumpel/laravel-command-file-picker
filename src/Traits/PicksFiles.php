<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\FileFinder;
use Illuminate\Support\Collection;

trait PicksFiles
{

    protected function askToPickFiles(string $path, callable $filter = null, bool $addAllOption = true): Collection
    {
        $finder = new FileFinder($this->laravel->make('files'));
        $files = $finder->getFilesInDirectory($path)
            ->filter($filter)->values();

        if ($files->isEmpty()) {
            throw new \LogicException('No files found to show.');
        }

        $linkedFiles = collect($files)
            ->transform(function (array $file) {
                return $file['link'];
            });

        if($addAllOption) {
            $linkedFiles->add('All');
        }

        $chosenFiles = $this->choice('Please pick a file', $linkedFiles->toArray());

        if($chosenFiles !== 'All') {
            $files =  $files->filter(function($class) use ($chosenFiles) {
                return $class['link'] === $chosenFiles;
            });
        }

        $files->transform(function ($class) {
            return collect($class)->only('path');
        });

        return $files;


    }
}
