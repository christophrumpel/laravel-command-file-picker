<?php

namespace BeyondCode\ErdGenerator\Tests;

use Christophrumpel\LaravelCommandFilePicker\ClassFinder;
use Christophrumpel\LaravelCommandFilePicker\Tests\Classes\Helper;
use Christophrumpel\LaravelCommandFilePicker\Tests\Classes\Support;
use Christophrumpel\LaravelCommandFilePicker\Tests\Models\Project;
use Christophrumpel\LaravelCommandFilePicker\Tests\Models\User;
use Orchestra\Testbench\TestCase;

class ClassFinderTest extends TestCase
{

    /** @test */
    public function it_can_find_class_names_from_directory()
    {
        $finder = new ClassFinder(app()->make('files'));

        $classNames = $finder->getClassesInDirectory(__DIR__ . "/Classes");

        $this->assertCount(2, $classNames);

        $this->assertSame(
            [Helper::class, Support::class],
            $classNames->values()->all()
        );
    }

    /** @test */
    public function it_can_find_model_names_from_directory()
    {
        $finder = new ClassFinder(app()->make('files'));

        $classNames = $finder->getModelsInDirectory(__DIR__ . "/Models");

        $this->assertCount(2, $classNames);

        $this->assertSame(
            [Project::class, User::class],
            $classNames->values()->all()
        );
    }

}
