<?php

use Aaix\LaravelCountries\Database\Factories\CountryFactory;
use Aaix\LaravelCountries\Database\Factories\CountryRegionFactory;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryRegion;
use Aaix\LaravelCountries\Models\CountryTranslation;
use Aaix\LaravelCountries\Models\CountryRegionTranslation;

/*
 * Coverage for the `scopeOrWhere*` mirror scopes. They are trivial OR-variants
 * of the corresponding `scopeWhere*` scopes; these tests confirm they combine
 * predicates with OR rather than AND (i.e. find rows matching either clause).
 */

beforeEach(function () {
    config()->set('translatable.locales', ['en', 'de']);
});

// ===== Scalar-column OR scopes on Country =====

it('orWhereIsoAlpha2 finds rows matching either alpha-2 code', function () {
    CountryFactory::new()->create(['iso_alpha_2' => 'DE']);
    CountryFactory::new()->create(['iso_alpha_2' => 'FR']);
    CountryFactory::new()->create(['iso_alpha_2' => 'JP']);

    $result = Country::whereIsoAlpha2('DE')->orWhereIsoAlpha2('FR')->get();

    expect($result->pluck('iso_alpha_2')->sort()->values()->all())->toBe(['DE', 'FR']);
});

it('orWhereIsoAlpha3 finds rows matching either alpha-3 code', function () {
    CountryFactory::new()->create(['iso_alpha_3' => 'DEU']);
    CountryFactory::new()->create(['iso_alpha_3' => 'FRA']);
    CountryFactory::new()->create(['iso_alpha_3' => 'JPN']);

    $result = Country::whereIsoAlpha3('DEU')->orWhereIsoAlpha3('FRA')->get();

    expect($result->pluck('iso_alpha_3')->sort()->values()->all())->toBe(['DEU', 'FRA']);
});

it('orWhereIsoNumeric finds rows matching either numeric code', function () {
    CountryFactory::new()->create(['iso_numeric' => '276']);
    CountryFactory::new()->create(['iso_numeric' => '250']);
    CountryFactory::new()->create(['iso_numeric' => '392']);

    $result = Country::whereIsoNumeric('276')->orWhereIsoNumeric('250')->get();

    expect($result->pluck('iso_numeric')->map(fn ($v) => (string) $v)->sort()->values()->all())
        ->toBe(['250', '276']);
});

it('orWherePhoneCode finds rows matching either phone code', function () {
    CountryFactory::new()->create(['international_phone' => '49']);
    CountryFactory::new()->create(['international_phone' => '33']);
    CountryFactory::new()->create(['international_phone' => '81']);

    $result = Country::wherePhoneCode('49')->orWherePhoneCode('33')->get();

    expect($result->pluck('international_phone')->sort()->values()->all())->toBe(['33', '49']);
});

it('orWhereUid finds rows matching either ULID', function () {
    $a = CountryFactory::new()->create();
    $b = CountryFactory::new()->create();
    CountryFactory::new()->create();

    $result = Country::whereUid($a->uid)->orWhereUid($b->uid)->get();

    expect($result->pluck('uid')->sort()->values()->all())->toBe(
        collect([$a->uid, $b->uid])->sort()->values()->all()
    );
});

it('orWhereGeoname finds rows matching either geoname id', function () {
    CountryFactory::new()->create(['geoname_id' => '2921044']);
    CountryFactory::new()->create(['geoname_id' => '3017382']);
    CountryFactory::new()->create(['geoname_id' => '1861060']);

    $result = Country::whereGeoname('2921044')->orWhereGeoname('3017382')->get();

    expect($result->pluck('geoname_id')->sort()->values()->all())->toBe(['2921044', '3017382']);
});

it('orWhereOficialName and orWhereOficialNameLike combine with OR', function () {
    CountryFactory::new()->create(['official_name' => 'Federal Republic of Germany']);
    CountryFactory::new()->create(['official_name' => 'French Republic']);
    CountryFactory::new()->create(['official_name' => 'Japan']);

    $exact = Country::whereOficialName('French Republic')
        ->orWhereOficialName('Japan')->get();
    expect($exact->pluck('official_name')->sort()->values()->all())->toBe(['French Republic', 'Japan']);

    $like = Country::whereOficialNameLike('Germany')
        ->orWhereOficialNameLike('Japan')->get();
    expect($like->pluck('official_name')->sort()->values()->all())->toBe([
        'Federal Republic of Germany',
        'Japan',
    ]);
});

it('orWhereIso matches alpha-2, alpha-3, or numeric code', function () {
    CountryFactory::new()->create(['iso_alpha_2' => 'DE', 'iso_alpha_3' => 'DEU', 'iso_numeric' => '276']);
    CountryFactory::new()->create(['iso_alpha_2' => 'FR', 'iso_alpha_3' => 'FRA', 'iso_numeric' => '250']);
    CountryFactory::new()->create(['iso_alpha_2' => 'JP', 'iso_alpha_3' => 'JPN', 'iso_numeric' => '392']);

    // whereIso itself OR-chains alpha_2 / alpha_3 / numeric. Chaining
    // another orWhereIso should pull in additional matches.
    $result = Country::whereIso('DEU')->orWhereIso('JP')->get();

    expect($result->pluck('iso_alpha_2')->sort()->values()->all())->toBe(['DE', 'JP']);
});

// ===== Translation-based OR scopes on Country =====

function seedCountryWithTranslation(string $iso, string $name, string $slug): Country
{
    $country = CountryFactory::new()->create(['iso_alpha_2' => $iso]);
    CountryTranslation::create([
        'lc_country_id' => $country->id,
        'locale' => 'en',
        'name' => $name,
        'slug' => $slug,
    ]);
    return $country;
}

it('orWhereName combines with OR on translated name', function () {
    seedCountryWithTranslation('DE', 'Germany', 'germany');
    seedCountryWithTranslation('FR', 'France', 'france');
    seedCountryWithTranslation('JP', 'Japan', 'japan');

    $result = Country::whereName('Germany')->orWhereName('France')->get();

    expect($result->pluck('iso_alpha_2')->sort()->values()->all())->toBe(['DE', 'FR']);
});

it('orWhereNameLike combines with OR on partial translated name', function () {
    seedCountryWithTranslation('DE', 'Germany', 'germany');
    seedCountryWithTranslation('FR', 'France', 'france');
    seedCountryWithTranslation('JP', 'Japan', 'japan');

    $result = Country::whereNameLike('Germ')->orWhereNameLike('Fran')->get();

    expect($result->pluck('iso_alpha_2')->sort()->values()->all())->toBe(['DE', 'FR']);
});

it('orWhereSlug combines with OR on translated slug', function () {
    seedCountryWithTranslation('DE', 'Germany', 'germany');
    seedCountryWithTranslation('FR', 'France', 'france');
    seedCountryWithTranslation('JP', 'Japan', 'japan');

    $result = Country::whereSlug('germany')->orWhereSlug('france')->get();

    expect($result->pluck('iso_alpha_2')->sort()->values()->all())->toBe(['DE', 'FR']);
});

it('orderByName sorts results by the translated name', function () {
    seedCountryWithTranslation('DE', 'Germany', 'germany');
    seedCountryWithTranslation('AT', 'Austria', 'austria');
    seedCountryWithTranslation('FR', 'France', 'france');

    $result = Country::orderByName('asc')->get();

    expect($result->pluck('iso_alpha_2')->values()->all())->toBe(['AT', 'FR', 'DE']);
    // AT → Austria, FR → France, DE → Germany (alphabetical)
});

// ===== OR scopes on CountryRegion =====

it('orWhereICAO / orWhereIUCN / orWhereTDWG combine with OR on CountryRegion', function () {
    $r1 = CountryRegionFactory::new()->create(['icao' => 'AFI', 'iucn' => 'Africa', 'tdwg' => 'AFR']);
    $r2 = CountryRegionFactory::new()->create(['icao' => 'EUR', 'iucn' => 'Europe', 'tdwg' => 'EUR']);
    CountryRegionFactory::new()->create(['icao' => 'NAT', 'iucn' => 'Americas', 'tdwg' => 'NAM']);

    expect(
        CountryRegion::whereICAO('AFI')->orWhereICAO('EUR')->pluck('id')->sort()->values()->all()
    )->toBe([$r1->id, $r2->id]);

    expect(
        CountryRegion::whereIUCN('Africa')->orWhereIUCN('Europe')->pluck('id')->sort()->values()->all()
    )->toBe([$r1->id, $r2->id]);

    expect(
        CountryRegion::whereTDWG('AFR')->orWhereTDWG('EUR')->pluck('id')->sort()->values()->all()
    )->toBe([$r1->id, $r2->id]);
});
