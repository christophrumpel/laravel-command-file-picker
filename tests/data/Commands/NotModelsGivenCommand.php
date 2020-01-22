<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands;

use Christophrumpel\LaravelCommandFilePicker\Traits\PicksClasses;
use Illuminate\Console\Command;

class NotModelsGivenCommand extends Command
{

    use PicksClasses;

    protected $signature = "run:test-command-no-models-given";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = $this->askToPickModels(__DIR__.'/../');

        $this->info('Thanks. You have chosen: '.$filePath);
    }

}
