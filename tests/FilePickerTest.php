<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests;

use Christophrumpel\LaravelCommandFilePicker\LaravelCommandFilePickerServiceProvider;
use Christophrumpel\LaravelCommandFilePicker\Tests\Commands\TestCommand;
use Illuminate\Console\Application;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class FilePickerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        Application::starting(function (Application $artisan) {
            $artisan->add(app(TestCommand::class));
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

        $this->artisan('run:test-command')
            ->expectsQuestion('Please pick a class', 'file-path')
            ->expectsOutput('Thanks. You have chosen: file-path');
    }
}
