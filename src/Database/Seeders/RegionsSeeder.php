<?php

namespace Aaix\LaravelCountries\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Aaix\LaravelCountries\Models\CountryRegion;
use Aaix\LaravelCountries\Models\CountryRegionTranslation;

class RegionsSeeder extends Seeder
{
    public function run(): void
    {
        if (Schema::hasTable('lc_regions') === false) {
            return;
        }

        $regions = [
            'africa' => [
                'name' => 'Africa',
                'iso_alpha_2' => 'AF',
                'icao_region' => 'AFI',
                'iucn_region' => 'Africa',
                'tdwg' => 'AFR',
            ],
            'americas' => [
                'name' => 'Americas',
                'iso_alpha_2' => 'AM',
                'icao_region' => 'NAT',
                'iucn_region' => 'Americas',
                'tdwg' => 'NAM/SAM',
            ],
            'asia' => [
                'name' => 'Asia',
                'iso_alpha_2' => 'AS',
                'icao_region' => 'ASI',
                'iucn_region' => 'Asia',
                'tdwg' => 'ASI',
            ],
            'europe' => [
                'name' => 'Europe',
                'iso_alpha_2' => 'EU',
                'icao_region' => 'EUR',
                'iucn_region' => 'Europe',
                'tdwg' => 'EUR',
            ],
            'oceania' => [
                'name' => 'Oceania',
                'iso_alpha_2' => 'OC',
                'icao_region' => 'PAC',
                'iucn_region' => 'Oceania',
                'tdwg' => 'OCN',
            ],
        ];

        foreach ($regions as $region) {
            $regionRecord = CountryRegion::updateOrCreate(
                ['iso_alpha_2' => $region['iso_alpha_2']],
                [
                    'icao' => $region['icao_region'],
                    'iucn' => $region['iucn_region'],
                    'tdwg' => $region['tdwg'],
                    'is_visible' => true,
                ]
            );

            CountryRegionTranslation::updateOrCreate(
                ['lc_region_id' => $regionRecord->id, 'locale' => 'en'],
                [
                    'name' => Str::title($region['name']),
                    'slug' => Str::slug($region['name'], '-'),
                ]
            );
        }
    }
}
