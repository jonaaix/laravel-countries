# Seeding

## The principle

A country-data package should do exactly two things:

1. **Create the tables** — handled by the migrations that auto-load on `php artisan migrate`.
2. **Keep the rows in sync** — handled by a single master seeder that's safe to re-run on every deploy.

No publish dance, no interactive per-language opt-in, no prompts.

## The master seeder

Call it from your application's `database/seeders/DatabaseSeeder.php`:

```php
use Aaix\LaravelCountries\Database\Seeders\DatabaseSeeder as CountriesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CountriesSeeder::class);
        // your own seeders here
    }
}
```

Then run:

```bash
php artisan db:seed
```

Or target it specifically:

```bash
php artisan db:seed --class="Aaix\\LaravelCountries\\Database\\Seeders\\DatabaseSeeder"
```

## What gets seeded

In order:

| Step | Seeder | Rows written |
|---|---|---|
| 1 | `RegionsSeeder` | 5 regions + 5 EN translations |
| 2 | 245 country seeders (`AD_Andorra` → `ZW_Zimbabwe`) | 245 countries + 1 EN translation each, plus 1 row in `extras`, `coordinates`, `geographical` per country |
| 3 | 8 language seeders (ar, de, es, fr, it, nl, pt, ru) | 245 translations per locale (≈ 1,960 additional rows) |
| 4 | `NativeNamesSeeder` | Updates `native_name` on all 245 countries |

## Idempotency guarantees

Every single write is a `Model::updateOrCreate([...key...], [...values...])` — keyed on:

- ISO alpha-2 (for countries)
- `(lc_country_id, locale)` or `(lc_region_id, locale)` (for translations)
- `lc_country_id` (for one-to-one sidecars: extras, coordinates)

Re-running the seeder on a fresh DB creates rows. Re-running it on a populated DB updates existing rows in place. Primary keys stay stable, so foreign keys in your own tables that reference country IDs keep pointing to the right row.

The one exception is `CountryGeographical` (GeoJSON features), which is `delete-then-create` per country — so upstream GeoJSON data changes propagate cleanly.

::: tip Running in deploy pipelines
`php artisan db:seed --no-interaction --class="Aaix\\LaravelCountries\\Database\\Seeders\\DatabaseSeeder"` runs fine on non-TTY CI runners. Add it to your deploy hook if you want country data to stay in sync with the package version automatically.
:::

## Native names

`native_name` (the country's name in its own primary language — "Deutschland", "日本", "Россия") lives on the main `lc_countries` table, populated by the separate `NativeNamesSeeder`. It's separate so that upstream country-data updates (merged from `lwwcas/laravel-countries`) don't overwrite it.

## Languages

All 9 supported languages are seeded by default — there's no opt-in. If you need to disable languages you don't use, filter after seeding:

```php
CountryTranslation::whereNotIn('locale', ['en', 'de'])->delete();
```

This runs safely because uniqueness constraints are `(lc_country_id, locale)`, and re-running the seeder would just re-create the missing translations. If you need the deletion to be persistent, run it after every seed.
