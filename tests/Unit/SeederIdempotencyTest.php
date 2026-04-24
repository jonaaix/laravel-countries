<?php

use Aaix\LaravelCountries\Database\Seeders\Countries\DE_Germany;
use Aaix\LaravelCountries\Database\Seeders\Languages\GermanLanguageSeeder;
use Aaix\LaravelCountries\Database\Seeders\RegionsSeeder;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryCoordinates;
use Aaix\LaravelCountries\Models\CountryExtras;
use Aaix\LaravelCountries\Models\CountryGeographical;
use Aaix\LaravelCountries\Models\CountryRegion;
use Aaix\LaravelCountries\Models\CountryRegionTranslation;
use Aaix\LaravelCountries\Models\CountryTranslation;

it('seeds regions idempotently — second run keeps stable IDs and no duplicates', function () {
    (new RegionsSeeder())->run();
    $firstRegionIds = CountryRegion::orderBy('iso_alpha_2')->pluck('id', 'iso_alpha_2')->toArray();
    $firstRegionCount = CountryRegion::count();
    $firstTranslationCount = CountryRegionTranslation::count();

    (new RegionsSeeder())->run();

    expect(CountryRegion::count())->toBe($firstRegionCount);
    expect(CountryRegionTranslation::count())->toBe($firstTranslationCount);
    expect(CountryRegion::orderBy('iso_alpha_2')->pluck('id', 'iso_alpha_2')->toArray())
        ->toBe($firstRegionIds);
});

it('seeds a country idempotently — relations upsert without duplicates', function () {
    (new RegionsSeeder())->run();
    (new DE_Germany())->run();

    $firstGermanyId = Country::where('iso_alpha_2', 'DE')->value('id');
    $firstCountryCount = Country::count();
    $firstExtrasCount = CountryExtras::count();
    $firstCoordinatesCount = CountryCoordinates::count();
    $firstGeographicalCount = CountryGeographical::count();
    $firstTranslationCount = CountryTranslation::count();

    (new DE_Germany())->run();

    expect(Country::where('iso_alpha_2', 'DE')->value('id'))->toBe($firstGermanyId);
    expect(Country::count())->toBe($firstCountryCount);
    expect(CountryExtras::count())->toBe($firstExtrasCount);
    expect(CountryCoordinates::count())->toBe($firstCoordinatesCount);
    expect(CountryGeographical::count())->toBe($firstGeographicalCount);
    expect(CountryTranslation::count())->toBe($firstTranslationCount);
});

it('seeds a language translation idempotently — no duplicate translations per locale', function () {
    (new RegionsSeeder())->run();
    (new DE_Germany())->run();
    (new GermanLanguageSeeder())->run();

    $germanyId = Country::where('iso_alpha_2', 'DE')->value('id');
    $firstTotal = CountryTranslation::where('locale', 'de')->count();
    $firstGermanyTranslationId = CountryTranslation::where('locale', 'de')
        ->where('lc_country_id', $germanyId)
        ->value('id');

    (new GermanLanguageSeeder())->run();

    expect(CountryTranslation::where('locale', 'de')->count())->toBe($firstTotal);
    expect(CountryTranslation::where('locale', 'de')->where('lc_country_id', $germanyId)->value('id'))
        ->toBe($firstGermanyTranslationId);
});
