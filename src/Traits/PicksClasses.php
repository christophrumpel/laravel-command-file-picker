<?php

namespace Christophrumpel\LaravelCommandFilePicker\Traits;

use Christophrumpel\LaravelCommandFilePicker\ClassFinder;
use Illuminate\Support\Collection;

trait PicksClasses
{

    protected function askToPickClasses(string $path, callable $filter = null, bool $addAllOption = true): Collection
    {
        $finder = new ClassFinder($this->laravel->make('files'));
        $classes = $finder->getClassesInDirectory($path)
            ->filter($filter)
            ->values();

        if ($classes->isEmpty()) {
            throw new \LogicException('No classes found to show.');
        }

        return $this->askChoice($classes, $addAllOption);
    }

    protected function askToPickModels(
        string $path = null,
        callable $filter = null,
        bool $addAllOption = true
    ): Collection {
        $path = $path ?? config('command-file-picker.model_path') ?? app_path();

        $finder = new ClassFinder($this->laravel->make('files'));
        $models = $finder->getModelsInDirectory($path)
            ->filter($filter)
            ->values();

        if ($models->isEmpty()) {
            throw new \LogicException('No models found to show.');
        }

        return $this->askChoice($models, $addAllOption);
    }

    private function askChoice(Collection $classes, bool $addAllOption = true): Collection
    {
        $linkedModels = $classes->map(function (array $model) {
            return $model['link'] ?? $model;
        });

        if ($classes->count() > 1 && $addAllOption) {
            $linkedModels->add('All');
        }

        $chosenClasses = $this->choice('Please pick a model', $linkedModels->toArray());

        if ($chosenClasses !== 'All') {
            $classes = $classes->filter(function ($class) use ($chosenClasses) {
                return $class['link'] === $chosenClasses;
            });
        }

        $classes->transform(function ($class) {
            return collect($class)->only('path', 'name');
        });

        return $classes;

    }

}
