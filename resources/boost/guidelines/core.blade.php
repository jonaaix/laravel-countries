## aaix/laravel-countries

Country data + translations (astrotomic/laravel-translatable) for Laravel. 245 countries, 9 locales (ar, de, en, es, fr, it, nl, pt, ru), idempotent seeders, zero-touch install.

### Install & seed

`composer require aaix/laravel-countries` → `php artisan migrate` → register the master seeder in the app's own `DatabaseSeeder`:

@verbatim
<code-snippet name="Seed via master seeder" lang="php">
$this->call(\Aaix\LaravelCountries\Database\Seeders\DatabaseSeeder::class);
</code-snippet>
@endverbatim

The master seeder is idempotent — safe to re-run on every deploy.

### Ergonomic helpers

The country model lives at `Aaix\LaravelCountries\Models\Country` (not `App\Models\Country`).

@verbatim
<code-snippet name="Helpers for common cases" lang="php">
use Aaix\LaravelCountries\Models\Country;

Country::getByCode('DE');          // alpha-2 lookup, case-insensitive
$country->nameInLang('de');        // name in explicit locale
$country->native_name;             // country's own language ("Deutschland", "日本", ...)
Country::listInLang('de');         // [iso => name] for dropdowns, N+1-free
</code-snippet>
@endverbatim

Standard Eloquent scopes: `whereIso`, `whereIsoAlpha2`, `whereIsoAlpha3`, `whereIsoNumeric`, `whereCurrency`, `whereBorders`, `whereDomain`, `whereDomains`, `whereLanguages`, `whereFlagColors`, `wherePhoneCode`, `whereIndependenceDay`, `whereStatistics`, `whereName`, `whereSlug`, `whereWmo`. Accessors include `$country->name` (current app locale, auto-fallback), `$country->official_name` (locale-independent), `$country->flag_emoji`, `$country->flag_colors` (plus `flag_colors_hex`, `flag_colors_rgb`, `flag_colors_cmyk`, `flag_colors_hsl`, `flag_colors_hsv`, `flag_colors_pantone`, `flag_colors_web`, `flag_colors_contrast`), `$country->currency`, `$country->borders`, `$country->timezones`. Relations: `region`, `coordinates`, `extras`, `geographical`.

### Avoid

- **`php artisan w-countries:install` / `w-countries:languages`** — these commands do not exist. Install is `composer require` + `migrate` + seed.
- **`vendor:publish`** for migrations or config — not supported, not needed. Migrations auto-load from the service provider.
- **`Country::all()` + `->translate($locale)->name` in a loop** — use `Country::listInLang($locale)` instead (single query).
- **Editing per-country seeder files** (`DE_Germany.php` etc.) to set `native_name` — keep those files merge-friendly with upstream. `native_name` is populated by the separate `NativeNamesSeeder`.
