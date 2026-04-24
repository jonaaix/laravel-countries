<p align="center">
  <a href="https://github.com/jonaaix/laravel-countries">
    <img src="https://raw.githubusercontent.com/jonaaix/laravel-countries/master/assets/laravel-countries.webp" alt="Laravel Countries Logo" width="120">
  </a>
</p>

<h1 align="center">Laravel Countries</h1>

<p align="center">
A modern Laravel country-data package — idempotent seeders, zero-touch install, ergonomic API.
</p>

<p align="center">
Opinionated fork of <a href="https://github.com/lwwcas/laravel-countries">lwwcas/laravel-countries</a>.
</p>

<p align="center">
  <a href="https://packagist.org/packages/aaix/laravel-countries"><img src="https://img.shields.io/packagist/v/aaix/laravel-countries.svg?style=flat-square" alt="Latest Version on Packagist"></a>
  <a href="https://packagist.org/packages/aaix/laravel-countries"><img src="https://img.shields.io/packagist/dt/aaix/laravel-countries.svg?style=flat-square" alt="Total Downloads"></a>
  <a href="https://github.com/jonaaix/laravel-countries/actions/workflows/tests.yml"><img src="https://img.shields.io/github/actions/workflow/status/jonaaix/laravel-countries/tests.yml?branch=master&label=tests&style=flat-square" alt="GitHub Actions"></a>
  <a href="https://github.com/jonaaix/laravel-countries/blob/master/LICENSE.md"><img src="https://img.shields.io/packagist/l/aaix/laravel-countries.svg?style=flat-square" alt="License"></a>
</p>

---

## Install

```bash
composer require aaix/laravel-countries
php artisan migrate
```

Migrations load automatically via the package service provider.

## Seed

You get 5 regions, 245 countries, 9 language translations (ar, de, en, es, fr, it, nl, pt, ru) and the `native_name` column populated in one idempotent pass. Re-running the seeder is safe: every write is an `updateOrCreate` keyed on ISO code / locale — stable primary keys, no duplicates, no unique-key violations.

### Option A — Run it once, by hand

If you just want to populate country data and be done with it, run the master seeder directly:

```bash
php artisan db:seed --class="Aaix\\LaravelCountries\\Database\\Seeders\\DatabaseSeeder"
```

That's it. No changes to your app's `DatabaseSeeder.php`, no `vendor:publish`, nothing to remember next time. Safe to re-run whenever you want to refresh the data (e.g. after a package update).

### Option B — Integrate into your deploy pipeline

If you want country data to stay in sync automatically across deploys, call the master seeder from your app's own `database/seeders/DatabaseSeeder.php`:

```php
public function run(): void
{
    $this->call(\Aaix\LaravelCountries\Database\Seeders\DatabaseSeeder::class);
    // your own seeders here
}
```

Then your normal `php artisan db:seed` (or `db:seed --force` in CI) runs country data alongside everything else. Because every write is idempotent, running it on every deploy is safe.

## Principle

A country-data package should do exactly two things: **create the tables** and **keep the rows in sync**. Three commands (`composer require`, `php artisan migrate`, `php artisan db:seed`) do both. The seeders are idempotent, so running them on every deploy keeps rows in sync with no extra wiring.

## Migrating from `lwwcas/laravel-countries`

Same 7-table schema, same Eloquent models, same query scopes, same country data. Migration is mostly a namespace swap — see the step-by-step guide in the docs:

**→ [Migrating from lwwcas](https://jonaaix.github.io/laravel-countries/migrating)**

## Usage

```php
use Aaix\LaravelCountries\Models\Country;

// Lookup
$de = Country::getByCode('DE');             // alpha-2, case-insensitive
$de = Country::whereIsoAlpha3('DEU')->first();
$de = Country::whereIso('276')->first();    // matches alpha-2, alpha-3, or numeric

// Names
$de->name;                                  // current app locale, falls back to config fallback
$de->nameInLang('ja');                      // "Germany" (falls back if 'ja' missing)
$de->official_name;                         // "Federal Republic of Germany"
$de->native_name;                           // "Deutschland"

// Bulk localized list — ready for dropdowns
Country::listInLang('de');
// Collection(['DE' => 'Deutschland', 'FR' => 'Frankreich', ...] sorted by name)

// Flag
$de->getFlagEmoji();                        // 🇩🇪
$de->flag_colors_hex;                       // ['#000000', '#DD0000', '#FFCE00']

// Relations
$de->region;                                // CountryRegion
$de->coordinates;                           // CountryCoordinates
$de->extras;                                // CountryExtras (religions, orgs, sports, internet stats)
$de->geographical;                          // CountryGeographical (GeoJSON)
```

Available query scopes: `whereIso`, `whereIsoAlpha2`, `whereIsoAlpha3`, `whereIsoNumeric`, `whereCurrency`, `whereBorders`, `whereDomain`, `whereLanguages`, `whereFlagColors`, `wherePhoneCode`, `whereIndependenceDay`, `whereStatistics`, `whereName`, `whereSlug`, `whereWmo`.

## Table layout

| Table | Purpose |
|---|---|
| `lc_regions` | 5 continents (Africa, Americas, Asia, Europe, Oceania) |
| `lc_region_translations` | Region names per locale |
| `lc_countries` | 245 countries — ISO codes, capital, currency, flag metadata, `native_name`, population, GDP etc. |
| `lc_countries_translations` | Country name + slug per locale |
| `lc_countries_coordinates` | Latitude/longitude and formatted coordinate variants |
| `lc_countries_geographical` | Country outline as GeoJSON |
| `lc_countries_extras` | Religions, international orgs, national sport, internet stats, cybersecurity agency |

Translations are handled by [`astrotomic/laravel-translatable`](https://github.com/Astrotomic/laravel-translatable) (already a dependency). The `withTranslation()` global scope eager-loads the current locale + fallback locale — so `Country::all()->pluck('name')` is one query, not N+1.

## Requirements

- PHP 8.2+
- Laravel 11+

## Testing

```bash
composer test
```

## Credits

- [Lucas Duarte](https://github.com/lwwcas) — original package author, country-data curator
- [Jonas Gnioui](https://github.com/jonaaix) — fork maintainer

## License

MIT. See [LICENSE.md](LICENSE.md).
