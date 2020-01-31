<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests;

use Christophrumpel\LaravelCommandFilePicker\LaravelCommandFilePickerServiceProvider;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands\NotFilesGivenCommand;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands\NotModelsGivenCommand;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands\PickFileCommand;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands\PickModelsCommand;
use Illuminate\Console\Application;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class PicksFileCommandTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        Application::starting(function (Application $artisan) {
            $artisan->add(app(PickFileCommand::class));
            $artisan->add(app(NotFilesGivenCommand::class));
        });
    }

    protected function getPackageProviders($app)
    {
        return [LaravelCommandFilePickerServiceProvider::class];
    }

    /** @test * */
    public function it_uses_method_from_trait_to_ask_show_choices()
    {
        Artisan::call('make:model UserModel');

        $this->artisan('run:test-command-pick-file')
            ->expectsQuestion('Please pick a file', '<href=file://'.__DIR__.'/Data/Commands/../Models/Project.php>'.__DIR__.'/Data/Commands/../Models/Project.php</>')
            ->expectsOutput('Thanks. You have chosen: '.__DIR__.'/Data/Commands/../Models/Project.php');
    }

    /** @test * */
    public function it_uses_throws_exception_if_no_classes_found()
    {
        $this->expectException(\LogicException::class);
        Artisan::call('run:test-command-no-files-given');
    }

}
