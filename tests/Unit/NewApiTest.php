<?php

use Aaix\LaravelCountries\Database\Factories\CountryFactory;
use Aaix\LaravelCountries\Database\Seeders\Countries\DE_Germany;
use Aaix\LaravelCountries\Database\Seeders\NativeNamesSeeder;
use Aaix\LaravelCountries\Database\Seeders\RegionsSeeder;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryTranslation;

beforeEach(function () {
    config()->set('translatable.locales', ['en', 'de', 'pt', 'ja']);
});

it('looks up a country by alpha-2 code via Country::getByCode (case-insensitive)', function () {
    CountryFactory::new()->create(['iso_alpha_2' => 'DE']);

    expect(Country::getByCode('DE'))->toBeInstanceOf(Country::class);
    expect(Country::getByCode('de'))->toBeInstanceOf(Country::class);
    expect(Country::getByCode('de')?->iso_alpha_2)->toBe('DE');
});

it('returns null from getByCode when the country does not exist', function () {
    CountryFactory::new()->create(['iso_alpha_2' => 'DE']);

    expect(Country::getByCode('XX'))->toBeNull();
});

it('returns name in a specific language via nameInLang', function () {
    $country = CountryFactory::new()->create(['iso_alpha_2' => 'DE']);
    CountryTranslation::create([
        'lc_country_id' => $country->id,
        'locale' => 'en',
        'name' => 'Germany',
        'slug' => 'germany',
    ]);
    CountryTranslation::create([
        'lc_country_id' => $country->id,
        'locale' => 'de',
        'name' => 'Deutschland',
        'slug' => 'deutschland',
    ]);

    expect($country->nameInLang('en'))->toBe('Germany');
    expect($country->nameInLang('de'))->toBe('Deutschland');
});

it('falls back to the fallback locale from nameInLang when the requested locale is missing', function () {
    $country = CountryFactory::new()->create(['iso_alpha_2' => 'DE']);
    CountryTranslation::create([
        'lc_country_id' => $country->id,
        'locale' => 'en',
        'name' => 'Germany',
        'slug' => 'germany',
    ]);

    expect($country->nameInLang('ja'))->toBe('Germany');
});

it('lists all countries in a specific locale via listInLang, sorted alphabetically', function () {
    $de = CountryFactory::new()->create(['iso_alpha_2' => 'DE']);
    $fr = CountryFactory::new()->create(['iso_alpha_2' => 'FR']);
    $at = CountryFactory::new()->create(['iso_alpha_2' => 'AT']);

    CountryTranslation::create(['lc_country_id' => $de->id, 'locale' => 'en', 'name' => 'Germany', 'slug' => 'germany']);
    CountryTranslation::create(['lc_country_id' => $de->id, 'locale' => 'de', 'name' => 'Deutschland', 'slug' => 'deutschland']);
    CountryTranslation::create(['lc_country_id' => $fr->id, 'locale' => 'en', 'name' => 'France', 'slug' => 'france']);
    CountryTranslation::create(['lc_country_id' => $fr->id, 'locale' => 'de', 'name' => 'Frankreich', 'slug' => 'frankreich']);
    CountryTranslation::create(['lc_country_id' => $at->id, 'locale' => 'en', 'name' => 'Austria', 'slug' => 'austria']);
    CountryTranslation::create(['lc_country_id' => $at->id, 'locale' => 'de', 'name' => 'Österreich', 'slug' => 'oesterreich']);

    $list = Country::listInLang('de')->all();

    expect($list)->toBe([
        'DE' => 'Deutschland',
        'FR' => 'Frankreich',
        'AT' => 'Österreich',
    ]);
});

it('falls back to fallback locale inside listInLang when a translation is missing', function () {
    $jp = CountryFactory::new()->create(['iso_alpha_2' => 'JP']);
    CountryTranslation::create(['lc_country_id' => $jp->id, 'locale' => 'en', 'name' => 'Japan', 'slug' => 'japan']);

    $list = Country::listInLang('de')->all();

    expect($list)->toBe(['JP' => 'Japan']);
});

it('seeds the native_name column idempotently via NativeNamesSeeder', function () {
    (new RegionsSeeder())->run();
    (new DE_Germany())->run();
    (new NativeNamesSeeder())->run();

    $country = Country::getByCode('DE');
    expect($country->native_name)->toBe('Deutschland');

    $firstCount = Country::count();
    (new NativeNamesSeeder())->run();

    expect(Country::count())->toBe($firstCount);
    expect(Country::getByCode('DE')->native_name)->toBe('Deutschland');
});
