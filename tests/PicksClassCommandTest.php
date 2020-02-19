<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests;

use Christophrumpel\LaravelCommandFilePicker\LaravelCommandFilePickerServiceProvider;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands\NotModelsGivenCommand;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands\PickModelsCommand;
use Christophrumpel\LaravelCommandFilePicker\Tests\Data\Models\User;
use Illuminate\Console\Application;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class PicksClassCommandTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        Application::starting(function (Application $artisan) {
            $artisan->add(app(PickModelsCommand::class));
            $artisan->add(app(NotModelsGivenCommand::class));
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

        $this->artisan('run:test-command-pick-model')
            ->expectsQuestion('Please pick a model', '<href=file://'.__DIR__.'/Data/Commands/../Models/User.php>'.User::class.'</>')
            ->expectsOutput('Thanks. You have chosen: '.User::class);
    }

    /** @test * */
    public function it_throws_exception_if_no_classes_found()
    {
        $this->expectException(\LogicException::class);
        Artisan::call('run:test-command-no-models-given');
    }

}
