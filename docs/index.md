---
layout: home

hero:
  name: "Laravel Countries"
  text: "Country data for Laravel, done right."
  tagline: "Idempotent seeders. Zero-touch install. Ergonomic API."
  image:
    src: /logo.webp
    alt: Laravel Countries Logo
  actions:
    - theme: brand
      text: Get Started
      link: /install
    - theme: alt
      text: View on GitHub
      link: https://github.com/jonaaix/laravel-countries

features:
  - title: Zero-touch install
    details: "composer require, php artisan migrate, php artisan db:seed. Migrations auto-load from the service provider; the master seeder runs the rest."
  - title: Idempotent seeders
    details: "Every seed run is an updateOrCreate keyed on ISO code. Re-run on every deploy: stable primary keys, no duplicates, no unique-key violations."
  - title: 245 countries, 9 languages
    details: "All countries with ISO codes, flag metadata, currency, borders, coordinates, demographics — translated into ar, de, en, es, fr, it, nl, pt, ru, plus a dedicated native_name column."
  - title: Ergonomic Eloquent API
    details: "Country::getByCode('DE'), $country->nameInLang('ja'), Country::listInLang('de'), plus a full catalog of whereIso / whereCurrency / whereBorders scopes."
---

<p style="text-align: center; margin-top: 3rem; opacity: 0.7; font-size: 0.9rem;">
Opinionated fork of <a href="https://github.com/lwwcas/laravel-countries">lwwcas/laravel-countries</a>.
</p>
