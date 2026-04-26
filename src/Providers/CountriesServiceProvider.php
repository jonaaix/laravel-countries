<?php

namespace Aaix\LaravelCountries\Providers;

use Aaix\LaravelCountries\WCountries;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CountriesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->setBasePath(__DIR__)
            ->name('aaix-countries')
            ->hasConfigFile('w-countries')
            ->discoversMigrations(path: '/Database/migrations')
            ->runsMigrations();
    }

    public function packageRegistered()
    {
        $this->app->bind('w-countries', function ($app) {
            return new WCountries();
        });

        $this->app->alias('laravel-countries', WCountries::class);
    }
}
