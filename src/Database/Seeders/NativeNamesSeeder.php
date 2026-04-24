<?php

namespace Aaix\LaravelCountries\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Aaix\LaravelCountries\Models\Country;

/**
 * Seeds the native_name column on lc_countries.
 *
 * Separated from the main country seeders so that native-name data can be
 * maintained and updated independently of the upstream country-data files.
 *
 * Idempotent — safe to re-run: each entry is a plain UPDATE keyed by ISO code.
 */
class NativeNamesSeeder extends Seeder
{
    public function run(): void
    {
        if (Schema::hasColumn('lc_countries', 'native_name') === false) {
            return;
        }

        foreach ($this->nativeNames() as $iso => $nativeName) {
            Country::withoutGlobalScopes()
                ->where('iso_alpha_2', $iso)
                ->update(['native_name' => $nativeName]);
        }
    }

    /**
     * Map of ISO 3166-1 alpha-2 → country's name in its own primary language.
     *
     * For multi-lingual countries (e.g. CH, BE) the form in the majority
     * language is used. Entries in non-Latin scripts are stored in their
     * native script (Arabic, Chinese, Japanese, Greek, Cyrillic, etc.).
     */
    protected function nativeNames(): array
    {
        return [
            'AD' => 'Andorra',
            'AE' => 'الإمارات العربية المتحدة',
            'AF' => 'افغانستان',
            'AG' => 'Antigua and Barbuda',
            'AI' => 'Anguilla',
            'AL' => 'Shqipëria',
            'AM' => 'Հայաստան',
            'AO' => 'Angola',
            'AQ' => 'Antarctica',
            'AR' => 'Argentina',
            'AS' => 'Amerika Sāmoa',
            'AT' => 'Österreich',
            'AU' => 'Australia',
            'AW' => 'Aruba',
            'AX' => 'Åland',
            'AZ' => 'Azərbaycan',

            'BA' => 'Bosna i Hercegovina',
            'BB' => 'Barbados',
            'BD' => 'বাংলাদেশ',
            'BE' => 'België',
            'BF' => 'Burkina Faso',
            'BG' => 'България',
            'BH' => 'البحرين',
            'BI' => 'Burundi',
            'BJ' => 'Bénin',
            'BL' => 'Saint-Barthélemy',
            'BM' => 'Bermuda',
            'BN' => 'Brunei Darussalam',
            'BO' => 'Bolivia',
            'BR' => 'Brasil',
            'BS' => 'The Bahamas',
            'BT' => 'འབྲུག་ཡུལ་',
            'BV' => 'Bouvetøya',
            'BW' => 'Botswana',
            'BY' => 'Беларусь',
            'BZ' => 'Belize',

            'CA' => 'Canada',
            'CC' => 'Cocos (Keeling) Islands',
            'CD' => 'République démocratique du Congo',
            'CF' => 'République centrafricaine',
            'CG' => 'République du Congo',
            'CH' => 'Schweiz',
            'CI' => "Côte d'Ivoire",
            'CK' => 'Cook Islands',
            'CL' => 'Chile',
            'CM' => 'Cameroun',
            'CN' => '中国',
            'CO' => 'Colombia',
            'CR' => 'Costa Rica',
            'CU' => 'Cuba',
            'CV' => 'Cabo Verde',
            'CX' => 'Christmas Island',
            'CY' => 'Κύπρος',
            'CZ' => 'Česko',

            'DE' => 'Deutschland',
            'DJ' => 'Djibouti',
            'DK' => 'Danmark',
            'DM' => 'Dominica',
            'DO' => 'República Dominicana',
            'DZ' => 'الجزائر',

            'EC' => 'Ecuador',
            'EE' => 'Eesti',
            'EG' => 'مصر',
            'EH' => 'الصحراء الغربية',
            'ER' => 'ኤርትራ',
            'ES' => 'España',
            'ET' => 'ኢትዮጵያ',

            'FI' => 'Suomi',
            'FJ' => 'Fiji',
            'FK' => 'Falkland Islands',
            'FM' => 'Micronesia',
            'FO' => 'Føroyar',
            'FR' => 'France',

            'GA' => 'Gabon',
            'GB' => 'United Kingdom',
            'GD' => 'Grenada',
            'GE' => 'საქართველო',
            'GF' => 'Guyane française',
            'GG' => 'Guernsey',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GL' => 'Kalaallit Nunaat',
            'GM' => 'Gambia',
            'GN' => 'Guinée',
            'GP' => 'Guadeloupe',
            'GQ' => 'Guinea Ecuatorial',
            'GR' => 'Ελλάδα',
            'GS' => 'South Georgia and the South Sandwich Islands',
            'GT' => 'Guatemala',
            'GU' => 'Guåhån',
            'GW' => 'Guiné-Bissau',
            'GY' => 'Guyana',

            'HK' => '香港',
            'HM' => 'Heard Island and McDonald Islands',
            'HN' => 'Honduras',
            'HR' => 'Hrvatska',
            'HT' => 'Haïti',
            'HU' => 'Magyarország',

            'ID' => 'Indonesia',
            'IE' => 'Éire',
            'IL' => 'ישראל',
            'IM' => 'Isle of Man',
            'IN' => 'भारत',
            'IO' => 'British Indian Ocean Territory',
            'IQ' => 'العراق',
            'IR' => 'ایران',
            'IS' => 'Ísland',
            'IT' => 'Italia',

            'JE' => 'Jersey',
            'JM' => 'Jamaica',
            'JO' => 'الأردن',
            'JP' => '日本',

            'KE' => 'Kenya',
            'KG' => 'Кыргызстан',
            'KH' => 'កម្ពុជា',
            'KI' => 'Kiribati',
            'KM' => 'Comores',
            'KN' => 'Saint Kitts and Nevis',
            'KP' => '조선',
            'KR' => '대한민국',
            'KW' => 'الكويت',
            'KY' => 'Cayman Islands',
            'KZ' => 'Қазақстан',

            'LA' => 'ປະເທດລາວ',
            'LB' => 'لبنان',
            'LC' => 'Saint Lucia',
            'LI' => 'Liechtenstein',
            'LK' => 'ශ්‍රී ලංකා',
            'LR' => 'Liberia',
            'LS' => 'Lesotho',
            'LT' => 'Lietuva',
            'LU' => 'Lëtzebuerg',
            'LV' => 'Latvija',
            'LY' => 'ليبيا',

            'MA' => 'المغرب',
            'MC' => 'Monaco',
            'MD' => 'Moldova',
            'ME' => 'Crna Gora',
            'MF' => 'Saint-Martin',
            'MG' => 'Madagasikara',
            'MH' => 'Marshall Islands',
            'MK' => 'Северна Македонија',
            'ML' => 'Mali',
            'MM' => 'မြန်မာ',
            'MN' => 'Монгол Улс',
            'MO' => '澳門',
            'MP' => 'Northern Mariana Islands',
            'MQ' => 'Martinique',
            'MR' => 'موريتانيا',
            'MS' => 'Montserrat',
            'MT' => 'Malta',
            'MU' => 'Maurice',
            'MV' => 'ދިވެހިރާއްޖެ',
            'MW' => 'Malawi',
            'MX' => 'México',
            'MY' => 'Malaysia',
            'MZ' => 'Moçambique',

            'NA' => 'Namibia',
            'NC' => 'Nouvelle-Calédonie',
            'NE' => 'Niger',
            'NF' => 'Norfolk Island',
            'NG' => 'Nigeria',
            'NI' => 'Nicaragua',
            'NL' => 'Nederland',
            'NO' => 'Norge',
            'NP' => 'नेपाल',
            'NR' => 'Naoero',
            'NU' => 'Niuē',
            'NZ' => 'Aotearoa',

            'OM' => 'عُمان',

            'PA' => 'Panamá',
            'PE' => 'Perú',
            'PF' => 'Polynésie française',
            'PG' => 'Papua New Guinea',
            'PH' => 'Pilipinas',
            'PK' => 'پاکستان',
            'PL' => 'Polska',
            'PM' => 'Saint-Pierre-et-Miquelon',
            'PN' => 'Pitcairn Islands',
            'PR' => 'Puerto Rico',
            'PS' => 'فلسطين',
            'PT' => 'Portugal',
            'PW' => 'Belau',
            'PY' => 'Paraguay',

            'QA' => 'قطر',

            'RE' => 'La Réunion',
            'RO' => 'România',
            'RS' => 'Србија',
            'RU' => 'Россия',
            'RW' => 'Rwanda',

            'SA' => 'المملكة العربية السعودية',
            'SB' => 'Solomon Islands',
            'SC' => 'Seychelles',
            'SD' => 'السودان',
            'SE' => 'Sverige',
            'SG' => 'Singapore',
            'SH' => 'Saint Helena',
            'SI' => 'Slovenija',
            'SJ' => 'Svalbard og Jan Mayen',
            'SK' => 'Slovensko',
            'SL' => 'Sierra Leone',
            'SM' => 'San Marino',
            'SN' => 'Sénégal',
            'SO' => 'Soomaaliya',
            'SR' => 'Suriname',
            'ST' => 'São Tomé e Príncipe',
            'SV' => 'El Salvador',
            'SY' => 'سوريا',
            'SZ' => 'eSwatini',

            'TC' => 'Turks and Caicos Islands',
            'TD' => 'Tchad',
            'TF' => 'Terres australes françaises',
            'TG' => 'Togo',
            'TH' => 'ประเทศไทย',
            'TJ' => 'Тоҷикистон',
            'TK' => 'Tokelau',
            'TL' => 'Timor-Leste',
            'TM' => 'Türkmenistan',
            'TN' => 'تونس',
            'TO' => 'Tonga',
            'TR' => 'Türkiye',
            'TT' => 'Trinidad and Tobago',
            'TV' => 'Tuvalu',
            'TW' => '臺灣',
            'TZ' => 'Tanzania',

            'UA' => 'Україна',
            'UG' => 'Uganda',
            'UM' => 'United States Minor Outlying Islands',
            'US' => 'United States of America',
            'UY' => 'Uruguay',
            'UZ' => 'Oʻzbekiston',

            'VA' => 'Città del Vaticano',
            'VC' => 'Saint Vincent and the Grenadines',
            'VE' => 'Venezuela',
            'VG' => 'British Virgin Islands',
            'VI' => 'Virgin Islands of the United States',
            'VN' => 'Việt Nam',
            'VU' => 'Vanuatu',

            'WF' => 'Wallis-et-Futuna',
            'WS' => 'Samoa',

            'YE' => 'اليمن',
            'YT' => 'Mayotte',

            'ZA' => 'South Africa',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        ];
    }
}
