# Changelog

All notable changes to `aaix/laravel-countries` will be documented in this file.

## [Fork] - 2026-04-24

Forked from `lwwcas/laravel-countries`. Architecture reset with focus on install and update ergonomics for modern Laravel (11, 12) projects.

### Breaking

- Package renamed to `aaix/laravel-countries`; PHP namespace renamed from `Lwwcas\LaravelCountries` to `Aaix\LaravelCountries`.
- Removed Artisan commands `w-countries:install` and `w-countries:languages`. Install is now: `composer require` + `php artisan migrate` + call the master seeder. No interactive prompts.
- Laravel `<= 10` no longer supported. Supports Laravel 11 and 12.

### Added

- `Country::getByCode(string $code)` — case-insensitive alpha-2 lookup.
- `$country->nameInLang(string $locale)` — localized name with fallback-locale fallback.
- `Country::listInLang(string $locale)` — `iso_alpha_2 => name` collection, sorted alphabetically, N+1-free.
- `native_name` column on `lc_countries` — country names in their own primary language (e.g. "Deutschland", "日本", "Россия") for all 245 countries, populated by dedicated `NativeNamesSeeder` so upstream country-data merges don't overwrite it.
- Master `DatabaseSeeder` that runs regions + 245 countries + 9 languages + native names in one idempotent pass.

### Changed

- All seeders are now idempotent via `updateOrCreate` keyed on ISO code / locale — safe to re-run on every deploy.
- Migrations use Laravel timestamp prefix convention, load automatically via the service provider (`hasMigrations`), no publish needed.
- `CountryTranslation` and `CountryRegionTranslation` `$fillable` expanded to include `lc_*_id` and `locale`.

### Removed

- `src/Commands/` (both install commands), `WithBasePackageTools` and `WithLanguages` traits (only used by those commands), `LanguagesSeeder.php` wrapper.
- Legacy CI files: `.travis.yml`, `.scrutinizer.yml`, `.styleci.yml`, `.php_cs.*`.
- `.github/workflows/deploy.yml` (VitePress docs auto-deploy) and the now-unreferenced root-level `assets/` directory.

---

## 3.4.6 - 2023-14-04

- Adding Russian language to country data and its translations

## 3.4.5 - 2023-14-04

- Refactor all seed naming system
## 3.4.4 - 2023-14-04

- Adding German language to country data and its translations

## 3.4.3 - 2023-13-04

- Remove unused AN country, besides not being officially allocated to ISO 3166-1 alpha-2
- Remove 'CY' duplicate
- Minor fixes

## 3.4.2 - 2023-13-04

- Adding Dutch language to country data and its translations

## 3.4.1 - 2023-13-04

- Adding Arabic language to country data and its translations

## 3.4.0 - 2023-13-04

- Support Laravel 10.x

## 3.3.1 - 2022-10-02

- Adding the Philippine country data and its translations
- Adding an easy way to update country information philippines
- Minor fixes

## 3.2.0 - 2022-10-02

- Support Laravel 9.x

## 3.1.0 - 2020-11-01

- Update the order that migrations are run
- Update Readme file

## 3.0.0 - 2020-11-01

- Complete module refactoring
