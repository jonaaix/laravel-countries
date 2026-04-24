# Migrating from `lwwcas/laravel-countries`

The two packages share the same 7-table schema, the same Eloquent models, the same query scopes, and the same country data. Migrating is mostly a namespace swap plus forgetting about the two install commands.

::: info At a glance
- No data loss — migration only adds the new `native_name` column.
- All query scopes (`whereIso`, `whereCurrency`, `whereBorders`, flag helpers, global scopes) are kept.
- `WCountries` facade alias is preserved.
- The two Artisan install commands are gone; replace them with `php artisan db:seed`.
:::

## 1. Swap the composer package

```bash
composer remove lwwcas/laravel-countries
composer require aaix/laravel-countries
```

## 2. Rename the namespace

Project-wide find-and-replace — catches everything:

```
Lwwcas\LaravelCountries  →  Aaix\LaravelCountries
```

```diff
- use Lwwcas\LaravelCountries\Models\Country;
+ use Aaix\LaravelCountries\Models\Country;
```

If you were using the `WCountries` facade, the alias is preserved — no change needed there.

## 3. Run migrations

```bash
php artisan migrate
```

The existing 7 tables stay as they are. A single additive migration adds `native_name` to `lc_countries`. Your existing country IDs are untouched, so any foreign keys in your own tables that reference `lc_countries.id` keep pointing at the right row.

## 4. Update your seeder call

```diff
  public function run(): void
  {
-     $this->call(\Lwwcas\LaravelCountries\Database\Seeders\LwwcasDatabaseSeeder::class);
+     $this->call(\Aaix\LaravelCountries\Database\Seeders\DatabaseSeeder::class);
  }
```

Then:

```bash
php artisan db:seed
```

The new master seeder runs regions + 245 countries + all 9 languages + native names in one pass. It's now idempotent — every write is an `updateOrCreate` keyed on ISO code / locale, so it's safe to re-run on every deploy.

See [Seeding](./seeding) for the full behavior.

## 5. Drop the old Artisan commands

`php artisan w-countries:install` and `php artisan w-countries:languages` no longer exist. Anything you had wired into your `Procfile`, Forge/Envoyer deploy scripts, or CI hooks that invoked them can be replaced with `php artisan db:seed`.

::: tip Languages
All 9 supported languages are seeded by default — there is no opt-in step. If you only need a subset, delete the unused locales after seeding (see [Seeding → Languages](./seeding#languages)).
:::

## Optional: adopt the new APIs

These are additive; your existing code keeps working regardless.

```php
use Aaix\LaravelCountries\Models\Country;

// Static lookup by alpha-2, case-insensitive
$de = Country::getByCode('DE');

// Localized name with fallback-locale fallback
$de->nameInLang('ja');        // falls back to English if 'ja' translation is missing

// The country in its own primary language
$de->native_name;             // "Deutschland"

// Dropdown-ready, sorted, N+1-free
Country::listInLang('de');
// ['AT' => 'Österreich', 'DE' => 'Deutschland', 'FR' => 'Frankreich', ...]
```

See [Usage & API](./usage) for the full reference.
