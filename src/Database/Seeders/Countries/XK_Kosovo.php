<?php

namespace Aaix\LaravelCountries\Database\Seeders\Countries;

use Aaix\LaravelCountries\Database\Seeders\Builder;
use Aaix\LaravelCountries\Abstract\CountrySeeder;

class XK_Kosovo extends CountrySeeder
{
    public ?string $lang = 'en';
    public ?string $region = 'europe';

    public function run()
    {
        $this->name = 'Kosovo';
        $this->official_name = 'Republic of Kosovo';
        $this->iso_alpha_2 = 'XK';
        $this->iso_alpha_3 = 'XKX';
        $this->iso_numeric = null;
        $this->international_phone = '383';

        $this->languages = ['sq', 'sr'];
        $this->tld = ['.xk'];
        $this->alternative_tlds = [];

        $this->internet_speed = [
            'average_speed_fixed' => '80 Mbps',
            'average_speed_mobile' => '35 Mbps',
        ];
        $this->internet_penetration = '93%';
        $this->cybersecurity_agency = 'Kosovo Cyber Security Council';
        $this->popular_technologies = ['PHP', 'JavaScript', 'WordPress'];

        $this->wmo = null;
        $this->geoname_id = '831053';

        $this->currency = [
            'name' => 'Euro',
            'code' => 'EUR',
            'symbol' => '€',
            'main_unit' => 'euro',
            'sub_unit' => 'cent',
            'sub_unit_to_unit' => 100,
            'banknotes' => ['5', '10', '20', '50', '100', '200', '500'],
            'coins_main' => ['1', '2'],
            'coins_sub' => ['1', '2', '5', '10', '20', '50'],
        ];

        $this->population = 1798506;
        $this->area = 10887;
        $this->capital = 'Pristina';

        $this->timezones = [
            [
                'timezone_id' => 'Europe/Belgrade',
                'standard_time' => 'UTC+1',
                'daylight_saving_time' => 'UTC+2',
            ],
        ];

        $this->independence_day = '2008-02-17';
        $this->international_organizations = [
            'IMF',
            'World Bank',
            'Council of Europe (observer)',
        ];
        $this->gdp = 9.4;
        $this->religions = ['Islam', 'Christianity (Roman Catholicism, Serbian Orthodoxy)'];
        $this->government = 'Parliamentary republic';
        $this->national_sport = 'Football (Soccer)';
        $this->borders = [
            ['name' => 'Albania', 'iso_alpha_2' => 'AL'],
            ['name' => 'Montenegro', 'iso_alpha_2' => 'ME'],
            ['name' => 'North Macedonia', 'iso_alpha_2' => 'MK'],
            ['name' => 'Serbia', 'iso_alpha_2' => 'RS'],
        ];

        $this->emoji = [
            'img' => '🇽🇰',
            'uCode' => 'U+1F1FD U+1F1F0',
            'html' => '&#x1F1FD;&#x1F1F0;',
            'css' => '\\1F1FD\\1F1F0',
            'decimal' => '&#127485;&#127472;',
            'utf8' => '🇽🇰',
            'utf16' => '🇽🇰',
            'shortcode' => ':flag-xk:',
            'hex' => '&#x1F1FD;&#x1F1F0;',
        ];

        $this->flag_colors = [
            [
                'name' => 'Blue',
                'web_name' => 'blue',
                'hex' => '#244AA5',
                'rgb' => '36,74,165',
                'cmyk' => '78,55,0,35',
                'hsl' => '221,64%,39%',
                'hsv' => '221,78%,65%',
                'pantone' => 'Pantone 286 C',
                'contrast' => '#FFFFFF',
            ],
            [
                'name' => 'Yellow',
                'web_name' => 'yellow',
                'hex' => '#D0A650',
                'rgb' => '208,166,80',
                'cmyk' => '0,20,62,18',
                'hsl' => '40,58%,56%',
                'hsv' => '40,62%,82%',
                'pantone' => 'Pantone 124 C',
                'contrast' => '#000000',
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
        ];

        $this->coordinates = [
            'latitude' => '42.6026',
            'longitude' => '20.9030',
            'dd' => '42.6026° N, 20.9030° E',
            'dms' => '42°36\'09.36" N, 20°54\'10.80" E',
            'dm' => '42°36.156\' N, 20°54.180\' E',
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
