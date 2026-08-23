<?php

namespace Aaix\LaravelCountries\Database\Seeders\Countries;

use Aaix\LaravelCountries\Database\Seeders\Builder;
use Aaix\LaravelCountries\Abstract\CountrySeeder;

class CW_Curacao extends CountrySeeder
{
    public ?string $lang = 'en';
    public ?string $region = 'americas';

    public function run()
    {
        $this->name = 'Curaçao';
        $this->official_name = 'Country of Curaçao';
        $this->iso_alpha_2 = 'CW';
        $this->iso_alpha_3 = 'CUW';
        $this->iso_numeric = '531';
        $this->international_phone = '599';

        $this->languages = ['nl', 'pap', 'en'];
        $this->tld = ['.cw'];
        $this->alternative_tlds = [];

        $this->internet_speed = [
            'average_speed_fixed' => '30 Mbps',
            'average_speed_mobile' => '20 Mbps',
        ];
        $this->internet_penetration = '78%';
        $this->cybersecurity_agency = 'Ministry of Justice';
        $this->popular_technologies = ['PHP', 'JavaScript', 'WordPress'];

        $this->wmo = null;
        $this->geoname_id = '7626836';

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

        $this->population = 155826;
        $this->area = 444;
        $this->capital = 'Willemstad';

        $this->timezones = [
            [
                'timezone_id' => 'America/Curacao',
                'standard_time' => 'UTC-4',
            ],
        ];

        $this->independence_day = null;
        $this->international_organizations = ['CARICOM (Associate)', 'United Nations (via Netherlands)'];
        $this->gdp = 3.1;
        $this->religions = ['Christianity (Roman Catholicism, Protestantism)'];
        $this->government = 'Constitutional monarchy within the Kingdom of the Netherlands';
        $this->national_sport = 'Baseball';
        $this->borders = [];

        $this->emoji = [
            'img' => '🇨🇼',
            'uCode' => 'U+1F1E8 U+1F1FC',
            'html' => '&#x1F1E8;&#x1F1FC;',
            'css' => '\\1F1E8\\1F1FC',
            'decimal' => '&#127464;&#127484;',
            'utf8' => '🇨🇼',
            'utf16' => '🇨🇼',
            'shortcode' => ':flag-cw:',
            'hex' => '&#x1F1E8;&#x1F1FC;',
        ];

        $this->flag_colors = [
            [
                'name' => 'Blue',
                'web_name' => 'blue',
                'hex' => '#012A87',
                'rgb' => '1,42,135',
                'cmyk' => '99,69,0,47',
                'hsl' => '221,99%,27%',
                'hsv' => '221,99%,53%',
                'pantone' => 'Pantone 286 C',
                'contrast' => '#FFFFFF',
            ],
            [
                'name' => 'Yellow',
                'web_name' => 'yellow',
                'hex' => '#F9E814',
                'rgb' => '249,232,20',
                'cmyk' => '0,7,92,2',
                'hsl' => '55,95%,53%',
                'hsv' => '55,92%,98%',
                'pantone' => 'Pantone 108 C',
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
            'latitude' => '12.1696',
            'longitude' => '-68.9900',
            'dd' => '12.1696° N, 68.9900° W',
            'dms' => '12°10\'10.56" N, 68°59\'24.00" W',
            'dm' => '12°10.176\' N, 68°59.400\' W',
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
