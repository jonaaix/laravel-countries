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
        $this->createTables();
    }

    protected function getPackageProviders($app)
    {
        return [
            CountriesServiceProvider::class,
        ];
    }

    public function createTables()
    {
        $migrationsPath = dirname(__DIR__) . '/src/Database/migrations';
        $this->loadMigrationsFrom($migrationsPath);
    }
}
