<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\ClassFinder;

trait PicksClasses
{
    protected function askToPickClasses($path): string
    {
        $finder = new ClassFinder(app()->make('files'));
        $classNames = $finder->getClassesInDirectory($path);

        return $this->choice('Please pick a class', $classNames->toArray());
    }

    protected function askToPickModel($path): string
    {
        $finder = new ClassFinder(app()->make('files'));
        $classNames = $finder->getModelsInDirectory($path);

        return $this->choice('Please pick a class', $classNames->toArray());
    }



}
