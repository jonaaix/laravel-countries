<?php

namespace Aaix\LaravelCountries\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Aaix\LaravelCountries\Providers\CountriesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('translatable.locales', ['en', 'pt']);
    }

    protected function getPackageProviders($app)
    {
        return [
            CountriesServiceProvider::class,
        ];
    }
}
