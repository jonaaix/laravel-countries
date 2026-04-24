<?php

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

it('should has a region relationship', function () {
    $region = CountryRegionFactory::new()->create();
    CountryFactory::new()->count(5)->create(['lc_region_id' => $region->id]);

    $country = Country::inRandomOrder()->first();

    expect($country->region()->first())->toBeInstanceOf(CountryRegion::class);
    expect($country->region()->first()->id)->toBe($region->id);
});

it('should has a geographical relationship', function () {
    $country = CountryFactory::new()->create();
    CountryGeographicalFactory::new()->create(['lc_country_id' => $country->id]);

    $country = Country::first();
    $geographical = $country->geographical()->first();

    expect($geographical)->not->toBeNull();
    expect($geographical->lc_country_id)->toBe($country->id);
    expect($geographical)->toBeInstanceOf(CountryGeographical::class);
});

it('should has a extras relationship', function () {
    $country = CountryFactory::new()->create();
    CountryExtrasFactory::new()->create(['lc_country_id' => $country->id]);
    $country = Country::first();
    $extras = $country->extras()->first();

    expect($extras)->not->toBeNull();
    expect($extras->lc_country_id)->toBe($country->id);
    expect($extras)->toBeInstanceOf(CountryExtras::class);
});

it('should has a coordinates relationship', function () {
    $country = CountryFactory::new()->create();
    CountryCoordinatesFactory::new()->create(['lc_country_id' => $country->id]);
    $country = Country::first();
    $coordinates = $country->coordinates()->first();

    expect($coordinates)->not->toBeNull();
    expect($coordinates->lc_country_id)->toBe($country->id);
    expect($coordinates)->toBeInstanceOf(CountryCoordinates::class);
});

it('should filters country by uid code', function () {
    $uid = '01J93N4EWBCTT28ARTWZEFBTS1';

    CountryFactory::new()->count(11)->create();
    $country = Country::inRandomOrder()->first();
    $country->uid = $uid;
    $country->save();

    $country = Country::whereUid($uid)->first();

    expect($country)->toBeInstanceOf(Country::class);
    expect($country->uid)->toBeString();
    expect($country->uid)->toEqual($uid);
});

it('should filters countries by Oficial Name', function () {
    $oficialName = 'United Kingdom';
    CountryFactory::new()->create([
        'official_name' => $oficialName,
    ]);
    CountryFactory::new()->count(5)->create();

    $country = Country::whereOficialName($oficialName)->first();

    expect($country)->toBeInstanceOf(Country::class);
    expect($country->official_name)->toEqual($oficialName);
    expect($country->official_name)->toBeString();
});

it('should filters countries by geoname_id', function () {
    CountryFactory::new()->create([
        'official_name' => 'United States of America',
        'geoname_id' => '4031074'
    ]);
    CountryFactory::new()->count(10)->create();

    $country = Country::whereGeoname('4031074')->first();
    expect($country)->toBeInstanceOf(Country::class);
    expect($country->official_name)->toEqual('United States of America');
    expect($country->geoname_id)->toEqual('4031074');

    $country = Country::whereGeoname(4031074)->first();
    expect($country)->toBeInstanceOf(Country::class);
    expect($country->official_name)->toEqual('United States of America');
    expect($country->geoname_id)->toEqual('4031074');
});
