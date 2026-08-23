<?php

namespace Aaix\LaravelCountries\Database\Seeders\Countries;

use Aaix\LaravelCountries\Database\Seeders\Builder;
use Aaix\LaravelCountries\Abstract\CountrySeeder;

class SS_SouthSudan extends CountrySeeder
{
    public ?string $lang = 'en';
    public ?string $region = 'africa';

    public function run()
    {
        $this->name = 'South Sudan';
        $this->official_name = 'Republic of South Sudan';
        $this->iso_alpha_2 = 'SS';
        $this->iso_alpha_3 = 'SSD';
        $this->iso_numeric = '728';
        $this->international_phone = '211';

        $this->languages = ['en', 'ar'];
        $this->tld = ['.ss'];
        $this->alternative_tlds = [];

        $this->internet_speed = [
            'average_speed_fixed' => '5 Mbps',
            'average_speed_mobile' => '10 Mbps',
        ];
        $this->internet_penetration = '10%';
        $this->cybersecurity_agency = 'National Communication Authority (NCA)';
        $this->popular_technologies = ['PHP', 'JavaScript', 'WordPress'];

        $this->wmo = 'SS';
        $this->geoname_id = '7909807';

        $this->currency = [
            'name' => 'South Sudanese pound',
            'code' => 'SSP',
            'symbol' => '£',
            'main_unit' => 'pound',
            'sub_unit' => 'piaster',
            'sub_unit_to_unit' => 100,
            'banknotes' => ['1', '5', '10', '20', '25', '50', '100', '500'],
            'coins_main' => [],
            'coins_sub' => ['10', '25', '50'],
        ];

        $this->population = 11088796;
        $this->area = 619745;
        $this->capital = 'Juba';

        $this->timezones = [
            [
                'timezone_id' => 'Africa/Juba',
                'standard_time' => 'UTC+2',
            ],
        ];

        $this->independence_day = '2011-07-09';
        $this->international_organizations = [
            'United Nations',
            'African Union',
            'East African Community',
            'IGAD',
        ];
        $this->gdp = 3.3;
        $this->religions = ['Christianity', 'Traditional African religions', 'Islam'];
        $this->government = 'Federal presidential republic (transitional)';
        $this->national_sport = 'Wrestling';
        $this->borders = [
            ['name' => 'Sudan', 'iso_alpha_2' => 'SD'],
            ['name' => 'Ethiopia', 'iso_alpha_2' => 'ET'],
            ['name' => 'Kenya', 'iso_alpha_2' => 'KE'],
            ['name' => 'Uganda', 'iso_alpha_2' => 'UG'],
            ['name' => 'Democratic Republic of the Congo', 'iso_alpha_2' => 'CD'],
            ['name' => 'Central African Republic', 'iso_alpha_2' => 'CF'],
        ];

        $this->emoji = [
            'img' => '🇸🇸',
            'uCode' => 'U+1F1F8 U+1F1F8',
            'html' => '&#x1F1F8;&#x1F1F8;',
            'css' => '\\1F1F8\\1F1F8',
            'decimal' => '&#127480;&#127480;',
            'utf8' => '🇸🇸',
            'utf16' => '🇸🇸',
            'shortcode' => ':flag-ss:',
            'hex' => '&#x1F1F8;&#x1F1F8;',
        ];

        $this->flag_colors = [
            [
                'name' => 'Black',
                'web_name' => 'black',
                'hex' => '#000000',
                'rgb' => '0,0,0',
                'cmyk' => '0,0,0,100',
                'hsl' => '0,0%,0%',
                'hsv' => '0,0%,0%',
                'pantone' => 'Black C',
                'contrast' => '#FFFFFF',
            ],
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
                'name' => 'Green',
                'web_name' => 'green',
                'hex' => '#078930',
                'rgb' => '7,137,48',
                'cmyk' => '95,0,65,46',
                'hsl' => '138,90%,28%',
                'hsv' => '138,95%,54%',
                'pantone' => 'Pantone 356 C',
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
                'hex' => '#0F47AF',
                'rgb' => '15,71,175',
                'cmyk' => '91,59,0,31',
                'hsl' => '219,84%,37%',
                'hsv' => '219,91%,69%',
                'pantone' => 'Pantone 286 C',
                'contrast' => '#FFFFFF',
            ],
            [
                'name' => 'Yellow',
                'web_name' => 'yellow',
                'hex' => '#FCDD09',
                'rgb' => '252,221,9',
                'cmyk' => '0,12,96,1',
                'hsl' => '52,98%,51%',
                'hsv' => '52,96%,99%',
                'pantone' => 'Pantone 116 C',
                'contrast' => '#000000',
            ],
        ];

        $this->coordinates = [
            'latitude' => '6.8770',
            'longitude' => '31.3070',
            'dd' => '6.8770° N, 31.3070° E',
            'dms' => '6°52\'37.20" N, 31°18\'25.20" E',
            'dm' => '6°52.620\' N, 31°18.420\' E',
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
