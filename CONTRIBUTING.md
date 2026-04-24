# Contributing

Contributions are welcome. This is a personal fork maintained by Jonas Gnioui — scope is intentionally narrow: keep the country data current, keep the install/update architecture honest, keep the API ergonomic.

## Before opening an issue

- Reproduce on a clean install (fresh `composer require` + `php artisan migrate` + run the master seeder).
- Check the existing issues and PRs.
- If the problem is upstream country data (names, ISO codes, flag metadata), consider filing it with [lwwcas/laravel-countries](https://github.com/lwwcas/laravel-countries) first — this fork pulls country data from there.

## Pull requests

- One concern per PR. Don't bundle a country-data fix with a refactor.
- Include tests. The suite runs with `composer test`. Seeder changes should be covered by an idempotency-style test (run twice, assert stable IDs, no duplicates).
- Follow PSR-12.
- Keep `native_name` data in `src/Database/Seeders/NativeNamesSeeder.php`. Do not put native names inside the per-country seeders — those files are kept merge-friendly with upstream.
- Do not add interactive Artisan commands or `php artisan vendor:publish` steps. Zero-touch install is a design principle of this fork.

## License

By submitting a PR you agree that your contribution is licensed under the MIT license of this package.
