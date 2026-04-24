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
            ->hasMigrations([
                'create_lc_regions_table',
                'create_lc_region_translations_table',
                'create_lc_countries_table',
                'create_lc_countries_translations_table',
                'create_lc_countries_geographical_table',
                'create_lc_countries_extras_table',
                'create_lc_countries_coordinates_table',
                'add_native_name_to_lc_countries_table',
            ]);
    }

    public function packageRegistered()
    {
        $this->app->bind('w-countries', function ($app) {
            return new WCountries();
        });

        $this->app->alias('laravel-countries', WCountries::class);
    }
}
