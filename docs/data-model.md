# Data Model

Seven tables, all prefixed `lc_` so they don't collide with app tables. Translations use [astrotomic/laravel-translatable](https://github.com/Astrotomic/laravel-translatable) — a separate row per (model, locale, attribute set).

## Overview

```
lc_regions  ◄───┐
                │ FK (cascade)
                │
lc_countries ───┼──► lc_countries_translations
                │
                ├──► lc_countries_coordinates  (1:1)
                ├──► lc_countries_extras       (1:1)
                └──► lc_countries_geographical (1:1)

lc_regions ────────► lc_region_translations
```

## `lc_regions`

5 fixed rows: Africa, Americas, Asia, Europe, Oceania.

| Column | Type | Notes |
|---|---|---|
| `id` | tinyIncrement | |
| `iso_alpha_2` | string unique | ISO 3166 region code (AF, AM, AS, EU, OC) |
| `icao` | string | ICAO region (AFI, NAT, …) |
| `iucn` | string | IUCN region |
| `tdwg` | string | WGSRPD code |
| `is_visible` | boolean | |

## `lc_region_translations`

| Column | Type | Notes |
|---|---|---|
| `id` | increments | |
| `lc_region_id` | FK → lc_regions.id (cascade) | |
| `locale` | string | |
| `name` | string | e.g. "Europe" / "Europa" / "Europa" |
| `slug` | string | |
| | | Unique (lc_region_id, locale) + (slug, locale) |

## `lc_countries`

245 countries. Locale-independent data lives here.

| Column | Notes |
|---|---|
| `id`, `uid` (ULID) | |
| `lc_region_id` | FK to region |
| `official_name` | "Federal Republic of Germany" |
| `native_name` | "Deutschland" (seeded by `NativeNamesSeeder`) |
| `capital` | |
| `iso_alpha_2`, `iso_alpha_3`, `iso_numeric` | |
| `international_phone` | |
| `geoname_id`, `wmo` | |
| `independence_day`, `population`, `area`, `gdp` | |
| `languages`, `tld`, `alternative_tld`, `borders`, `timezones`, `currency` | JSON |
| `flag_emoji`, `flag_colors`, `flag_colors_web/hex/rgb/cmyk/hsl/hsv/pantone`, `flag_colors_contrast` | JSON |
| `is_visible` | boolean — filtered out by global scope |

Unique on `(lc_region_id, iso_alpha_2)`.

## `lc_countries_translations`

| Column | Notes |
|---|---|
| `lc_country_id` | FK (cascade) |
| `locale` | |
| `name` | "Germany" / "Deutschland" / "Allemagne" |
| `slug` | "germany" / "deutschland" |
| | Unique (lc_country_id, locale) + (slug, locale) |

## `lc_countries_coordinates`

One row per country. Stores the same geographic point in 4 formats:

| Column | Example |
|---|---|
| `latitude`, `longitude` | "51.1657", "10.4515" |
| `degrees_with_decimal` (dd) | "51.1657°N, 10.4515°E" |
| `degrees_minutes_seconds` (dms) | "51°9'56.52"N, 10°27'5.40"E" |
| `degrees_and_decimal_minutes` (dm) | "51°9.942'N, 10°27.09'E" |
| `gps` | JSON — derived GPS format extensions |

## `lc_countries_geographical`

GeoJSON outline (FeatureCollection projected down to a single Feature for each country).

| Column |
|---|
| `lc_country_id` |
| `type` (e.g. "FeatureCollection") |
| `features_type` (e.g. "Feature") |
| `properties` (JSON) |
| `geometry` (JSON — Polygon or MultiPolygon) |

## `lc_countries_extras`

| Column | Notes |
|---|---|
| `national_sport` | "Football" |
| `cybersecurity_agency` | e.g. "BSI" |
| `popular_technologies` | JSON array |
| `internet` | JSON — speed + penetration |
| `religions` | JSON array |
| `international_organizations` | JSON array — "UN", "EU", "NATO", etc. |

## Notes on translatable locales

The default configured locales are `en` + Astrotomic's fallback. All 9 languages ship in the seeder but only show up via accessors if your `config/translatable.php` lists them as allowed locales.

If you need more, set them in `config/translatable.php`:

```php
'locales' => ['en', 'de', 'fr', 'it', 'nl', 'pt', 'ru', 'es', 'ar'],
'fallback_locale' => 'en',
```
