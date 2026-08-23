<?php

namespace Aaix\LaravelCountries\Database\Seeders\Countries;

use Aaix\LaravelCountries\Database\Seeders\Builder;
use Aaix\LaravelCountries\Abstract\CountrySeeder;

class BQ_CaribbeanNetherlands extends CountrySeeder
{
    public ?string $lang = 'en';
    public ?string $region = 'americas';

    public function run()
    {
        $this->name = 'Bonaire, Sint Eustatius and Saba';
        $this->official_name = 'Bonaire, Sint Eustatius and Saba';
        $this->iso_alpha_2 = 'BQ';
        $this->iso_alpha_3 = 'BES';
        $this->iso_numeric = '535';
        $this->international_phone = '599';

        $this->languages = ['nl', 'pap', 'en'];
        $this->tld = ['.bq', '.nl'];
        $this->alternative_tlds = [];

        $this->internet_speed = [
            'average_speed_fixed' => '25 Mbps',
            'average_speed_mobile' => '15 Mbps',
        ];
        $this->internet_penetration = '82%';
        $this->cybersecurity_agency = 'Rijksdienst Caribisch Nederland (RCN)';
        $this->popular_technologies = ['PHP', 'JavaScript', 'WordPress'];

        $this->wmo = null;
        $this->geoname_id = '7626844';

        $this->currency = [
            'name' => 'United States dollar',
            'code' => 'USD',
            'symbol' => '$',
            'main_unit' => 'dollar',
            'sub_unit' => 'cent',
            'sub_unit_to_unit' => 100,
            'banknotes' => ['1', '2', '5', '10', '20', '50', '100'],
            'coins_main' => ['1'],
            'coins_sub' => ['1', '5', '10', '25', '50'],
        ];

        $this->population = 27148;
        $this->area = 328;
        $this->capital = 'Kralendijk';

        $this->timezones = [
            [
                'timezone_id' => 'America/Kralendijk',
                'standard_time' => 'UTC-4',
            ],
        ];

        $this->independence_day = null;
        $this->international_organizations = ['United Nations (via Netherlands)'];
        $this->gdp = 0.4;
        $this->religions = ['Christianity (Roman Catholicism, Protestantism)'];
        $this->government = 'Special municipalities of the Netherlands';
        $this->national_sport = 'Kite surfing';
        $this->borders = [];

        $this->emoji = [
            'img' => '🇧🇶',
            'uCode' => 'U+1F1E7 U+1F1F6',
            'html' => '&#x1F1E7;&#x1F1F6;',
            'css' => '\\1F1E7\\1F1F6',
            'decimal' => '&#127463;&#127478;',
            'utf8' => '🇧🇶',
            'utf16' => '🇧🇶',
            'shortcode' => ':flag-bq:',
            'hex' => '&#x1F1E7;&#x1F1F6;',
        ];

        $this->flag_colors = [
            [
                'name' => 'Red',
                'web_name' => 'red',
                'hex' => '#AE1C28',
                'rgb' => '174,28,40',
                'cmyk' => '0,84,77,32',
                'hsl' => '355,72%,40%',
                'hsv' => '355,84%,68%',
                'pantone' => 'Pantone 186 C',
                'contrast' => '#FFFFFF',
            ],
            [
                'name' => 'White',
                'web_name' => 'white',
                'hex' => '#FFFFFF',
                'rgb' => '255,255,255',
                'cmyk' => '0,0,0,0',
                'hsl' => '0,0%,100%',
                'hsv' => '0,0%,100%',
                'pantone' => 'Pantone White',
                'contrast' => '#000000',
            ],
            [
                'name' => 'Blue',
                'web_name' => 'navy blue',
                'hex' => '#21468B',
                'rgb' => '33,70,139',
                'cmyk' => '76,50,0,45',
                'hsl' => '215,62%,34%',
                'hsv' => '215,76%,55%',
                'pantone' => 'Pantone 286 C',
                'contrast' => '#FFFFFF',
            ],
        ];

        $this->coordinates = [
            'latitude' => '12.1784',
            'longitude' => '-68.2385',
            'dd' => '12.1784° N, 68.2385° W',
            'dms' => '12°10\'42.24" N, 68°14\'18.60" W',
            'dm' => '12°10.704\' N, 68°14.310\' W',
            'gps' => [],
        ];

        $this->geographical = json_decode($this->geographical(), true);

        Builder::country($this);
    }

    public function geographical()
    {
        return '{"type":"FeatureCollection","features":[]}';
    }
}
