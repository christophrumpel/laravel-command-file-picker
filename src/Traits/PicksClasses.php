<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\ClassFinder;
use Illuminate\Support\Collection;

trait PicksClasses
{

    protected function askToPickClasses(string $path, callable $filter = null): string
    {
        $finder = new ClassFinder($this->laravel->make('files'));
        $classes = $finder->getClassesInDirectory($path)
            ->filter($filter)->values();

        if ($classes->isEmpty()) {
            throw new \LogicException('No classes found to show.');
        }

        return $this->askChoice($classes);
    }

    protected function askToPickModels(string $path = null, callable $filter = null): string
    {
        $path = $path ?? config('command-file-picker.model_path') ?? app_path();

        $finder = new ClassFinder($this->laravel->make('files'));
        $models = $finder->getModelsInDirectory($path)
            ->filter($filter)->values();

        if ($models->isEmpty()) {
            throw new \LogicException('No models found to show.');
        }

        return $this->askChoice($models);
    }

    private function askChoice(Collection $classes): string
    {
        $linkedModels = $classes->map(function (array $model) {
                return $model['link'];
            })
            ->toArray();

        $chosenClass = $this->choice('Please pick a model', $linkedModels);

        return $classes->filter(function ($class) use ($chosenClass) {
            return $class['link'] === $chosenClass;
        })
            ->first()['name'];
    }

}
