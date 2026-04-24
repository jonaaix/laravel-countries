<?php

use Illuminate\Support\Collection;
use Aaix\LaravelCountries\Database\Factories\CountryFactory;
use Aaix\LaravelCountries\Database\Factories\CountryRegionFactory;
use Aaix\LaravelCountries\Database\Factories\CountryRegionTranslationFactory;
use Aaix\LaravelCountries\Database\Factories\CountryTranslationFactory;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryRegion;

it('should remove the translation global scope on Country Model', function () {
    CountryFactory::new()->count(5)->create();
    CountryTranslationFactory::new()->count(7)->create([
        'locale' => 'en',
    ]);

    $queryWithoutTranslationScope = Country::withNotTranslation()->get();

    $countriesWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class);
    expect($countriesWithoutTranslation->count())->toBe(0);
});

it('should apply the translation global scope on Country Model', function () {
    CountryFactory::new()->count(5)->create();
    CountryTranslationFactory::new()->count(7)->create([
        'locale' => 'en',
    ]);

    $queryWithoutTranslationScope = Country::all();

    $countriesWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class);
    expect($countriesWithoutTranslation->count())->toBe(12);
});

it('should remove the translation global scope on Region Model', function () {
    CountryRegionFactory::new()->count(5)->create();
    CountryRegionTranslationFactory::new()->count(7)->create([
        'locale' => 'en',
    ]);

    $queryWithoutTranslationScope = CountryRegion::withNotTranslation()->get();

    $regionsWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class);
    expect($regionsWithoutTranslation->count())->toBe(0);
});

it('should apply the translation global scope on Region Model', function () {
    CountryRegionFactory::new()->count(5)->create();
    CountryRegionTranslationFactory::new()->count(7)->create([
        'locale' => 'en',
    ]);

    $queryWithoutTranslationScope = CountryRegion::all();

    $regionsWithoutTranslation = $queryWithoutTranslationScope->filter(function ($country) {
        return $country->relationLoaded('translations');
    });

    expect($queryWithoutTranslationScope)->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class);
    expect($regionsWithoutTranslation->count())->toBe(12);
});
