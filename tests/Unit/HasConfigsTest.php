<?php

use Illuminate\Support\Carbon;
use Aaix\LaravelCountries\Models\Country;

/*
 * HasConfigs is a thin wrapper around config('w-countries.*') reads.
 * Tests cover: the package's shipped default values AND honoring
 * explicit overrides set via config().
 */

it('getConfigLocaleKey honors config override and defaults to "locale"', function () {
    $country = new Country();

    expect($country->getConfigLocaleKey())->toBe('locale');

    config()->set('w-countries.locale_key', 'lang');
    expect($country->getConfigLocaleKey())->toBe('lang');
});

it('getConfigIsCache reads the configured flag', function () {
    $country = new Country();

    config()->set('w-countries.cache.is_cached', true);
    expect($country->getConfigIsCache())->toBeTrue();

    config()->set('w-countries.cache.is_cached', false);
    expect($country->getConfigIsCache())->toBeFalse();
});

it('getConfigPrefixCache reads the configured prefix and defaults to null', function () {
    $country = new Country();

    expect($country->getConfigPrefixCache())->toBeNull();

    config()->set('w-countries.cache.prefix', 'aaix');
    expect($country->getConfigPrefixCache())->toBe('aaix');
});

it('getConfigSmallTimeCache returns a Carbon instance', function () {
    $country = new Country();

    expect($country->getConfigSmallTimeCache())->toBeInstanceOf(Carbon::class);
});

it('getConfigBigTimeCache returns a Carbon instance', function () {
    $country = new Country();

    expect($country->getConfigBigTimeCache())->toBeInstanceOf(Carbon::class);
});

it('getConfigSmallTimeCache and getConfigBigTimeCache honor explicit config overrides', function () {
    $country = new Country();

    $customSmall = Carbon::now()->addMinutes(30);
    $customBig = Carbon::now()->addYears(5);

    config()->set('w-countries.cache.small_time', $customSmall);
    config()->set('w-countries.cache.big_time', $customBig);

    expect($country->getConfigSmallTimeCache()->equalTo($customSmall))->toBeTrue();
    expect($country->getConfigBigTimeCache()->equalTo($customBig))->toBeTrue();
});
