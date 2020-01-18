<?php

namespace BeyondCode\ErdGenerator\Tests;

use Christophrumpel\LaravelCommandFilePicker\ModelFinder;
use Christophrumpel\LaravelCommandFilePicker\Tests\Models\Project;
use Christophrumpel\LaravelCommandFilePicker\Tests\Models\User;
use Orchestra\Testbench\TestCase;

class ModelFinderTest extends TestCase
{

    /** @test */
    public function it_can_find_class_names_from_directory()
    {
        $finder = new ModelFinder(app()->make('files'));

        $classNames = $finder->getModelsInDirectory(__DIR__ . "/Models");

        $this->assertCount(2, $classNames);

        $this->assertSame(
            [Project::class, User::class],
            $classNames->values()->all()
        );
    }

}
