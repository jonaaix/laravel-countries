---
layout: home

hero:
  name: "Laravel Countries"
  text: "Country data for Laravel, done right."
  tagline: "Idempotent seeders. Zero-touch install. Ergonomic API. A 2026 lift of lwwcas/laravel-countries."
  image:
    src: /logo.webp
    alt: Laravel Countries Logo
  actions:
    - theme: brand
      text: Install
      link: /install
    - theme: alt
      text: View on GitHub
      link: https://github.com/jonaaix/laravel-countries

features:
  - title: Zero-touch install
    details: "composer require, php artisan migrate — done. No interactive prompts, no vendor:publish, no install command that breaks on non-TTY CI runners."
  - title: Idempotent seeders
    details: "Every seed run is an updateOrCreate keyed on ISO code. Re-run on every deploy: stable primary keys, no duplicates, no unique-key violations."
  - title: 245 countries, 9 languages
    details: "All countries with ISO codes, flag metadata, currency, borders, coordinates, demographics — translated into ar, de, en, es, fr, it, nl, pt, ru, plus a dedicated native_name column."
  - title: Drop-in Eloquent feel
    details: "Country::getByCode('DE'), $country->nameInLang('ja'), Country::listInLang('de') — plus all the whereIso / whereCurrency / whereBorders scopes from upstream."
---
