<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\ModelFinder;

trait PicksClasses
{

    protected function askToPickModel($path): string
    {
        $finder = new ModelFinder(app()->make('files'));
        $classNames = $finder->getModelsInDirectory($path);

        return $this->choice('Please pick a class', $classNames->toArray());
    }

}
