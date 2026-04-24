# Install

## Requirements

- PHP 8.2+
- Laravel 11+

## Install the package

```bash
composer require aaix/laravel-countries
```

## Run migrations

```bash
php artisan migrate
```

That's it. Migrations are auto-loaded by the package's service provider — no `vendor:publish`, no install command, no prompts. The following tables are created:

- `lc_regions`, `lc_region_translations`
- `lc_countries`, `lc_countries_translations`
- `lc_countries_coordinates`, `lc_countries_geographical`, `lc_countries_extras`

## Seed the data

See [Seeding](./seeding) for the full story. The short version:

```php
// database/seeders/DatabaseSeeder.php
public function run(): void
{
    $this->call(\Aaix\LaravelCountries\Database\Seeders\DatabaseSeeder::class);
}
```

```bash
php artisan db:seed
```

Re-run it as often as you like — every write is idempotent.

## Why no install command?

The upstream package (`lwwcas/laravel-countries`) ships an `w-countries:install` command with interactive prompts. That's fine in a local shell, fatal on a production deploy: CI runners have no TTY, seeding decisions get made at deploy time, not install time. This fork trades the prompt for Laravel conventions you already know.
