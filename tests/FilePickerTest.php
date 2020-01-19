<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests;


use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class FilePickerTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [TestServiceProvider::class];
    }

   /** @test **/
   public function it_uses_method_from_trait_to_ask_show_choices()
   {
       Artisan::call('make:model UserModel');

       $this->artisan('run:test-command')
           ->expectsQuestion('Please pick a class', 'file-path')
           ->expectsOutput('Thanks. You have chosen: file-path');
   }
}
