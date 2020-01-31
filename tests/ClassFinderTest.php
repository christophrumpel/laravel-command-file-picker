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

        $classNames = $finder->getClassesInDirectory(__DIR__."/Data/Classes");

        $this->assertCount(2, $classNames);

        $this->assertSame([
            [
                'path' => __DIR__.'/Data/Classes/Helper.php',
                'name' => Helper::class,
                'link' => '<href=file://'.__DIR__.'/Data/Classes/Helper.php>'.Helper::class.'</>'
            ],
            [
                'path' => __DIR__.'/Data/Classes/Support.php',
                'name' => Support::class,
                'link' => '<href=file://'.__DIR__.'/Data/Classes/Support.php>'.Support::class.'</>'
            ],
        ], $classNames->toArray());
    }

    /** @test */
    public function it_can_find_model_names_within_directory()
    {
        $finder = new ClassFinder(app()->make('files'));
        $classNames = $finder->getModelsInDirectory(__DIR__."/Data/Models");

        $this->assertCount(2, $classNames);

        $this->assertSame([
            [
                'path' =>   __DIR__.'/Data/Models/Project.php',
                'name' => Project::class,
                'link' => '<href=file://'.__DIR__.'/Data/Models/Project.php>'.Project::class.'</>'
            ],
            [
                'path' =>  __DIR__.'/Data/Models/User.php',
                'name' => User::class,
                'link' => '<href=file://'.__DIR__.'/Data/Models/User.php>'.User::class.'</>'
            ],
        ], $classNames->toArray());
    }

}
