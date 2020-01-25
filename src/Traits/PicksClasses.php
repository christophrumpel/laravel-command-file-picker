<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\ClassFinder;

trait PicksClasses
{

    protected function askToPickClasses($path): string
    {
        $finder = new ClassFinder($this->laravel->make('files'));
        $classNames = $finder->getClassesInDirectory($path);

        if ($classNames->isEmpty()) {
            return $this->error("No classes found in \"$path\".");
        }

        return $this->choice('Please pick a class', $classNames->toArray());
    }

    protected function askToPickModels($path = null): string
    {
        $path = $path ?? app_path();

        $finder = new ClassFinder($this->laravel->make('files'));
        $classNames = $finder->getModelsInDirectory($path);

        if ($classNames->isEmpty()) {
            throw new \LogicException('No models found to show.');
        }

        return $this->choice('Please pick a model', $classNames->toArray());
    }

}
