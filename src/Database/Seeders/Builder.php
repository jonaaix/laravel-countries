<?php

namespace Aaix\LaravelCountries\Database\Seeders;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Aaix\LaravelCountries\Abstract\CountrySeeder;
use Aaix\LaravelCountries\Models\Country;
use Aaix\LaravelCountries\Models\CountryCoordinates;
use Aaix\LaravelCountries\Models\CountryExtras;
use Aaix\LaravelCountries\Models\CountryGeographical;
use Aaix\LaravelCountries\Models\CountryRegion;
use Aaix\LaravelCountries\Models\CountryRegionTranslation;
use Aaix\LaravelCountries\Models\CountryTranslation;

class Builder
{
    public static function country(CountrySeeder $country): void
    {
        self::builder($country);
    }

    protected static function builder(CountrySeeder $country): void
    {
        DB::transaction(function () use ($country) {
            $region = CountryRegion::whereSlug($country->region, $country->lang)->firstOrFail();

            $countryRecord = Country::updateOrCreate(
                ['iso_alpha_2' => $country->iso_alpha_2],
                [
                    'lc_region_id' => $region->id,
                    'capital' => $country->capital,
                    'official_name' => $country->official_name,
                    'iso_alpha_3' => $country->iso_alpha_3,
                    'iso_numeric' => $country->iso_numeric,
                    'international_phone' => $country->international_phone,
                    'geoname_id' => $country->geoname_id,
                    'wmo' => $country->wmo,
                    'independence_day' => $country->independence_day,
                    'population' => $country->population,
                    'area' => $country->area,
                    'gdp' => $country->gdp,
                    'languages' => $country->languages,
                    'tld' => $country->tld,
                    'alternative_tld' => $country->alternative_tlds,
                    'borders' => array_map('strtolower', array_column($country->borders, 'iso_alpha_2')) ?? [],
                    'timezones' => [
                        'main' => $country->timezones[0] ?? [],
                        'others' => array_slice($country->timezones ?? [], 1),
                    ],
                    'currency' => [
                        'name' => $country->currency['name'] ?? null,
                        'code' => $country->currency['code'] ?? null,
                        'symbol' => $country->currency['symbol'] ?? null,
                        'banknotes' => $country->currency['banknotes'] ?? [],
                        'coins' => [
                            'main' => $country->currency['coins_main'] ?? [],
                            'sub' => $country->currency['coins_sub'] ?? [],
                        ],
                        'unit' => [
                            'main' => $country->currency['main_unit'] ?? null,
                            'sub' => $country->currency['sub_unit'] ?? null,
                            'to_unit' => $country->currency['sub_unit_to_unit'] ?? null,
                        ],
                    ],
                    'flag_emoji' => [
                        'img' => $country->emoji['img'] ?? null,
                        'utf8' => $country->emoji['utf8'] ?? null,
                        'utf16' => $country->emoji['utf16'] ?? null,
                        'uCode' => $country->emoji['uCode'] ?? null,
                        'hex' => $country->emoji['hex'] ?? null,
                        'html' => $country->emoji['html'] ?? null,
                        'css' => $country->emoji['css'] ?? null,
                        'decimal' => $country->emoji['decimal'] ?? null,
                        'shortcode' => $country->emoji['shortcode'] ?? null,
                    ],
                    'flag_colors' => array_column($country->flag_colors ?? [], 'name'),
                    'flag_colors_web' => array_column($country->flag_colors ?? [], 'web_name'),
                    'flag_colors_contrast' => array_column($country->flag_colors ?? [], 'contrast'),
                    'flag_colors_hex' => array_column($country->flag_colors ?? [], 'hex'),
                    'flag_colors_rgb' => array_column($country->flag_colors ?? [], 'rgb'),
                    'flag_colors_cmyk' => array_column($country->flag_colors ?? [], 'cmyk'),
                    'flag_colors_hsl' => array_column($country->flag_colors ?? [], 'hsl'),
                    'flag_colors_hsv' => array_column($country->flag_colors ?? [], 'hsv'),
                    'flag_colors_pantone' => array_column($country->flag_colors ?? [], 'pantone'),
                    'is_visible' => true,
                ]
            );

            CountryTranslation::updateOrCreate(
                ['lc_country_id' => $countryRecord->id, 'locale' => $country->lang],
                [
                    'name' => $country->name,
                    'slug' => Str::slug($country->name, '-'),
                ]
            );

            CountryExtras::updateOrCreate(
                ['lc_country_id' => $countryRecord->id],
                [
                    'national_sport' => $country->national_sport,
                    'cybersecurity_agency' => $country->cybersecurity_agency,
                    'popular_technologies' => $country->popular_technologies ?? [],
                    'internet' => [
                        'speed' => [
                            'average_fixed' => $country->internet_speed['average_speed_fixed'] ?? null,
                            'average_mobile' => $country->internet_speed['average_speed_mobile'] ?? null,
                        ],
                        'penetration' => $country->internet_penetration,
                    ],
                    'religions' => $country->religions ?? [],
                    'international_organizations' => $country->international_organizations ?? [],
                ]
            );

            CountryCoordinates::updateOrCreate(
                ['lc_country_id' => $countryRecord->id],
                [
                    'latitude' => $country->coordinates['latitude'] ?? null,
                    'longitude' => $country->coordinates['longitude'] ?? null,
                    'degrees_with_decimal' => $country->coordinates['dd'] ?? null,
                    'degrees_minutes_seconds' => $country->coordinates['dms'] ?? null,
                    'degrees_and_decimal_minutes' => $country->coordinates['dm'] ?? null,
                    'gps' => [],
                ]
            );

            $geographical = $country->geographical;
            CountryGeographical::where('lc_country_id', $countryRecord->id)->delete();
            if (isset($geographical['type']) && isset($geographical['features'][0])) {
                $countryRecord->geographical()->create([
                    'type' => $geographical['type'],
                    'features_type' => $geographical['features'][0]['type'] ?? null,
                    'properties' => $geographical['features'][0]['properties'] ?? [],
                    'geometry' => $geographical['features'][0]['geometry'] ?? [],
                ]);
            }
        });
    }

    public static function regionsTranslations(array $regions, string $lang): void
    {
        DB::transaction(function () use ($regions, $lang) {
            foreach ($regions as $slug => $region) {
                $regionRecord = CountryRegion::whereTranslation('locale', 'en')
                    ->whereTranslation('slug', $slug)
                    ->first();

                if ($regionRecord === null) {
                    throw new Exception('Region ' . $region . ' not found (expected base slug "' . $slug . '" in "en")');
                }

                CountryRegionTranslation::updateOrCreate(
                    ['lc_region_id' => $regionRecord->id, 'locale' => $lang],
                    [
                        'name' => Str::title(trim($region)),
                        'slug' => Str::slug($region, '-'),
                    ]
                );
            }
        });
    }

    public static function countriesTranslations(array $countries, string $lang): void
    {
        DB::transaction(function () use ($countries, $lang) {
            foreach ($countries as $iso => $country) {
                $countryRecord = Country::where('iso_alpha_2', $iso)
                    ->orWhere('iso_alpha_3', $iso)
                    ->first();

                if ($countryRecord === null) {
                    continue;
                }

                CountryTranslation::updateOrCreate(
                    ['lc_country_id' => $countryRecord->id, 'locale' => $lang],
                    [
                        'name' => Str::title(trim($country)),
                        'slug' => Str::slug($country, '-'),
                    ]
                );
            }
        });
    }
}
