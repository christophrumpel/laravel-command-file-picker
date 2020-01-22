<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests\Data\Commands;

use Christophrumpel\LaravelCommandFilePicker\Traits\PicksClasses;
use Christophrumpel\LaravelCommandFilePicker\Traits\PicksFiles;
use Illuminate\Console\Command;

class NotFilesGivenCommand extends Command
{

    use PicksFiles;

    protected $signature = "run:test-command-no-files-given";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = $this->askToPickFiles(__DIR__.'/../');

        $this->info('Thanks. You have chosen: '.$filePath);
    }

}
