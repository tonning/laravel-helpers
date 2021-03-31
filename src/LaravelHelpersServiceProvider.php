<?php

namespace Tonning\LaravelHelpers;

use Illuminate\Database\Eloquent\Builder as Eloquent;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class LaravelHelpersServiceProvider extends ServiceProvider
{
    public function register()
    {
        Builder::macro('toSqlRaw', function () {
            return array_reduce($this->getBindings(), function ($sql, $binding) {
                return preg_replace('/\?/', is_numeric($binding) ? $binding : "'".$binding."'", $sql, 1);
            }, $this->toSql());
        });

        Eloquent::macro('toSqlRaw', function () {
            return $this->getQuery()->toSqlRaw();
        });
    }
}
