<?php

namespace BeyondCode\ErdGenerator\Tests;

use Orchestra\Testbench\TestCase;
use Christophrumpel\LaravelCommandFilePicker\ClassFinder;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Models\User;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Models\Project;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Classes\Helper;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Classes\Support;

class ClassFinderTest extends TestCase
{

    /** @test */
    public function it_can_find_class_names_within_directory()
    {
        $finder = new ClassFinder(app()->make('files'));

        $classNames = $finder->getClassesInDirectory(__DIR__ . "/data/Classes");

        $this->assertCount(2, $classNames);

        $this->assertSame(
            [Helper::class, Support::class],
            $classNames->values()->all()
        );
    }

    /** @test */
    public function it_can_find_model_names_within_directory()
    {
        $finder = new ClassFinder(app()->make('files'));
        $classNames = $finder->getModelsInDirectory(__DIR__ . "/data/Models");

        $this->assertCount(2, $classNames);

        $this->assertSame(
            [Project::class, User::class],
            $classNames->values()->all()
        );
    }

}
