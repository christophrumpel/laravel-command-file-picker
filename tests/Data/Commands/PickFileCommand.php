<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands;

use Christophrumpel\LaravelCommandFilePicker\Traits\PicksFiles;
use Illuminate\Console\Command;

class PickFileCommand extends Command
{

    use PicksFiles;

    protected $signature = "run:test-command-pick-file";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filesCollection = $this->askToPickFiles(__DIR__.'/../Models');

        $choice = $filesCollection->count() > 1 ? 'all given files' : $filesCollection->first()['path'];

        $this->info('Thanks. You have chosen: '.$choice);
    }

}
