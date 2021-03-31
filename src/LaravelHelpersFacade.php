<?php

namespace Tonning\LaravelHelpers;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tonning\LaravelHelpers\LaravelHelpers
 */
class LaravelHelpersFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-helpers';
    }
}
