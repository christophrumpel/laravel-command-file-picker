<?php

namespace Christophrumpel\LaravelCommandFilePicker;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Christophrumpel\LaravelCommandFilePicker\Skeleton\SkeletonClass
 */
class LaravelCommandFilePickerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-command-file-picker';
    }
}
