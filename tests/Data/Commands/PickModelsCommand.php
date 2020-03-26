<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands;

use Christophrumpel\LaravelCommandFilePicker\Traits\PicksClasses;
use Illuminate\Console\Command;

class PickModelsCommand extends Command
{

    use PicksClasses;

    protected $signature = "run:test-command-pick-model";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $choiceCollection = $this->askToPickModels(__DIR__.'/../Models');

        $choice = $choiceCollection->count() > 1 ? 'all given models' : $choiceCollection->first()['name'];

        $this->info('Thanks. You have chosen: '.$choice);
    }

}
