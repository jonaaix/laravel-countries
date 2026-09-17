<?php

namespace Aaix\LaravelCountries\Database\Seeders\Countries;

use Aaix\LaravelCountries\Abstract\CountrySeeder;
use Aaix\LaravelCountries\Database\Seeders\Builder;

class SX_SintMaarten extends CountrySeeder
{
    public ?string $lang = 'en';

    public ?string $region = 'americas';

    public function run()
    {
        $this->name = 'Sint Maarten';
        $this->official_name = 'Country of Sint Maarten';
        $this->iso_alpha_2 = 'SX';
        $this->iso_alpha_3 = 'SXM';
        $this->iso_numeric = '534';
        $this->international_phone = '1-721';

        $this->languages = ['nl', 'en'];
        $this->tld = ['.sx'];
        $this->alternative_tlds = [];

        $this->internet_speed = [
            'average_speed_fixed' => '25 Mbps',
            'average_speed_mobile' => '20 Mbps',
        ];
        $this->internet_penetration = '80%';
        $this->cybersecurity_agency = 'Ministry of Justice';
        $this->popular_technologies = ['PHP', 'JavaScript', 'WordPress'];

        $this->wmo = null;
        $this->geoname_id = '7609695';

        $this->currency = [
            'name' => 'Netherlands Antillean guilder',
            'code' => 'ANG',
            'symbol' => 'ƒ',
            'main_unit' => 'guilder',
            'sub_unit' => 'cent',
            'sub_unit_to_unit' => 100,
            'banknotes' => ['10', '25', '50', '100', '250'],
            'coins_main' => ['1', '2.5', '5'],
            'coins_sub' => ['1', '5', '10', '25', '50'],
        ];

        $this->population = 42876;
        $this->area = 34;
        $this->capital = 'Philipsburg';

        $this->timezones = [
            [
                'timezone_id' => 'America/Lower_Princes',
                'standard_time' => 'UTC-4',
            ],
        ];

        $this->independence_day = null;
        $this->international_organizations = ['CARICOM (Associate)', 'United Nations (via Netherlands)'];
        $this->gdp = 1.2;
        $this->religions = ['Christianity (Roman Catholicism, Protestantism)'];
        $this->government = 'Constitutional monarchy within the Kingdom of the Netherlands';
        $this->national_sport = 'Cricket';
        $this->borders = [
            ['name' => 'Saint Martin (French part)', 'iso_alpha_2' => 'MF'],
        ];

        $this->emoji = [
            'img' => '🇸🇽',
            'uCode' => 'U+1F1F8 U+1F1FD',
            'html' => '&#x1F1F8;&#x1F1FD;',
            'css' => '\\1F1F8\\1F1FD',
            'decimal' => '&#127480;&#127485;',
            'utf8' => '🇸🇽',
            'utf16' => '🇸🇽',
            'shortcode' => ':flag-sx:',
            'hex' => '&#x1F1F8;&#x1F1FD;',
        ];

        $this->flag_colors = [
            [
                'name' => 'Red',
                'web_name' => 'red',
                'hex' => '#CE1126',
                'rgb' => '206,17,38',
                'cmyk' => '0,92,82,19',
                'hsl' => '353,85%,44%',
                'hsv' => '353,92%,81%',
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
                'web_name' => 'blue',
                'hex' => '#12689C',
                'rgb' => '18,104,156',
                'cmyk' => '88,33,0,39',
                'hsl' => '203,79%,34%',
                'hsv' => '203,88%,61%',
                'pantone' => 'Pantone 7691 C',
                'contrast' => '#FFFFFF',
            ],
        ];

        $this->coordinates = [
            'latitude' => '18.0425',
            'longitude' => '-63.0548',
            'dd' => '18.0425° N, 63.0548° W',
            'dms' => '18°02\'33.00" N, 63°03\'17.28" W',
            'dm' => '18°02.550\' N, 63°03.288\' W',
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
