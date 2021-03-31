<?php

namespace Tonning\LaravelHelpers;

use Illuminate\Database\Eloquent\Builder as Eloquent;
use Illuminate\Database\Query\Builder;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tonning\LaravelHelpers\Commands\LaravelHelpersCommand;

class LaravelHelpersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel_helpers')
        ;
    }

    public function packageRegistered()
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
