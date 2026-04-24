<?php

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Model;
use Aaix\LaravelCountries\Database\Factories\CountryCoordinatesFactory;
use Aaix\LaravelCountries\Database\Factories\CountryExtrasFactory;
use Aaix\LaravelCountries\Database\Factories\CountryFactory;
use Aaix\LaravelCountries\Database\Factories\CountryGeographicalFactory;
use Aaix\LaravelCountries\Database\Factories\CountryRegionFactory;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryCoordinates;
use Aaix\LaravelCountries\Models\CountryExtras;
use Aaix\LaravelCountries\Models\CountryGeographical;
use Aaix\LaravelCountries\Models\CountryRegion;

dataset('models', [
    [Country::class, CountryFactory::class],
    [CountryRegion::class, CountryRegionFactory::class],
    [CountryCoordinates::class, CountryCoordinatesFactory::class],
    [CountryExtras::class, CountryExtrasFactory::class],
    [CountryGeographical::class, CountryGeographicalFactory::class],
]);

it('should apply the shouldBeStrict on model', function ($model, $factory) {
    $factory::new()->count(5)->create();

    $model::shouldBeStrict(true);

    $query = $model::all();

    expect($query)->each->toBeInstanceOf($model);
    expect($query)->each->not()->toBeNull();
})->with('models');

it('should do not apply the shouldBeStrict on model', function ($model, $factory) {
    $factory::new()->count(5)->create();

    $query = $model::all();

    expect($query)->each->toBeInstanceOf($model);
    expect($query)->each->not()->toBeNull();
})->with('models');

it('should has localeKey default value for shouldBeStrict', function ($model, $factory) {
    $factory::new()->count(5)->create();

    $query = $model::inRandomOrder()->first();

    expect($query)->not()->toBeNull();
    expect($query)->toBeInstanceOf($model);

    $defaultLocaleKey = config('w-countries.locale_key', 'locale');

    expect($query->localeKey)->not()->toBeNull();
    expect($query->localeKey)->toBeString();
    expect($query->localeKey)->toEqual($defaultLocaleKey);
})->with('models');
