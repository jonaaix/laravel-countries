<?php

use Illuminate\Support\Facades\App;
use Aaix\LaravelCountries\Database\Factories\CountryFactory;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryTranslation;

/*
 * Regressions tests for bugs inherited from the upstream codebase and
 * fixed in the 2026 architecture reset. Each test targets a specific
 * line that used to fail.
 */

beforeEach(function () {
    config()->set('translatable.locales', ['en', 'de', 'fr', 'it']);
});

it('Country::getGeoData() returns null instead of crashing when there is no geographical row', function () {
    $country = CountryFactory::new()->create(['iso_alpha_2' => 'DE']);

    // No CountryGeographical record was created for this country.
    expect($country->getGeoData())->toBeNull();
});

it('scopeWhereNameLike finds a country by its plain name (no leading-space bug)', function () {
    $country = CountryFactory::new()->create(['iso_alpha_2' => 'DE']);
    CountryTranslation::create([
        'lc_country_id' => $country->id,
        'locale' => 'en',
        'name' => 'Germany',
        'slug' => 'germany',
    ]);

    App::setLocale('en');

    // With the old `'% ' . $name . '%'` pattern, this returned 0 rows.
    $found = Country::whereNameLike('Germany')->first();

    expect($found)->toBeInstanceOf(Country::class);
    expect($found->iso_alpha_2)->toBe('DE');
});

it('scopeWhereNameLike still supports partial matches', function () {
    $country = CountryFactory::new()->create(['iso_alpha_2' => 'DE']);
    CountryTranslation::create([
        'lc_country_id' => $country->id,
        'locale' => 'en',
        'name' => 'Germany',
        'slug' => 'germany',
    ]);

    App::setLocale('en');

    expect(Country::whereNameLike('erman')->first())->toBeInstanceOf(Country::class);
    expect(Country::whereNameLike('Germ')->first())->toBeInstanceOf(Country::class);
});

it('scopeWhereDomains returns countries matching ANY of the given TLDs (OR-logic)', function () {
    CountryFactory::new()->create(['iso_alpha_2' => 'DE', 'tld' => ['.de']]);
    CountryFactory::new()->create(['iso_alpha_2' => 'FR', 'tld' => ['.fr']]);
    CountryFactory::new()->create(['iso_alpha_2' => 'JP', 'tld' => ['.jp']]);

    // With the old AND-logic, this returned 0 rows — no country has both TLDs.
    $results = Country::whereDomains(['.de', '.fr'])->pluck('iso_alpha_2')->sort()->values()->all();

    expect($results)->toBe(['DE', 'FR']);
});

it('scopeWhereDomainsAlternative also uses OR-logic', function () {
    CountryFactory::new()->create(['iso_alpha_2' => 'DE', 'alternative_tld' => ['.gmbh']]);
    CountryFactory::new()->create(['iso_alpha_2' => 'FR', 'alternative_tld' => ['.paris']]);
    CountryFactory::new()->create(['iso_alpha_2' => 'JP', 'alternative_tld' => ['.tokyo']]);

    $results = Country::whereDomainsAlternative(['.gmbh', '.paris'])->pluck('iso_alpha_2')->sort()->values()->all();

    expect($results)->toBe(['DE', 'FR']);
});
