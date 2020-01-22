<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands;

use Christophrumpel\LaravelCommandFilePicker\Traits\PicksClasses;
use Illuminate\Console\Command;

class PickModelsCommand extends Command
{

    use PicksClasses;

    protected $signature = "run:test-command";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = $this->askToPickModels(__DIR__.'/../Models');

        $this->info('Thanks. You have chosen: '.$filePath);
    }

}
