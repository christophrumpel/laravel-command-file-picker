<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests\Commands;

use Christophrumpel\LaravelCommandFilePicker\Traits\PicksClasses;
use Illuminate\Console\Command;

class TestCommand extends Command
{

    use PicksClasses;

    protected $signature = "run:test-command";

    protected $hidden = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = $this->askToPickModel(__DIR__.'/../Models');

        $this->info('Thanks. You have chosen: '.$filePath);
    }

}
