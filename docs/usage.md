# Usage & API

## Lookup

```php
use Aaix\LaravelCountries\Models\Country;

// Alpha-2, case-insensitive (preferred)
$de = Country::getByCode('DE');
$de = Country::getByCode('de');

// Any ISO code — matches alpha-2, alpha-3 or numeric
$de = Country::whereIso('DE')->first();
$de = Country::whereIso('DEU')->first();
$de = Country::whereIso('276')->first();

// Explicit
$de = Country::whereIsoAlpha2('DE')->first();
$de = Country::whereIsoAlpha3('DEU')->first();
$de = Country::whereIsoNumeric('276')->first();
```

## Names

Country names live in the translations table, available in 9 languages (ar, de, en, es, fr, it, nl, pt, ru). The `name` attribute is locale-aware by default.

```php
$de->name;                   // Uses current app locale, falls back to config('translatable.fallback_locale')
$de->nameInLang('ja');       // "Germany" — falls back to fallback_locale when 'ja' isn't available
$de->nameInLang('de');       // "Deutschland"

$de->official_name;          // "Federal Republic of Germany" — locale-independent
$de->native_name;            // "Deutschland" — the country's own language
```

### Bulk-localized list

For dropdowns, selects, etc.:

```php
Country::listInLang('de');
// Illuminate\Support\Collection(['AT' => 'Österreich', 'DE' => 'Deutschland', 'FR' => 'Frankreich', ...])
```

Single query with eager-loaded translations, sorted alphabetically by the translated name. N+1-free.

```blade
<select name="country">
    @foreach(Country::listInLang(app()->getLocale()) as $iso => $name)
        <option value="{{ $iso }}">{{ $name }}</option>
    @endforeach
</select>
```

## Flag metadata

```php
$de->getFlagEmoji();         // 🇩🇪
$de->getFlagEmojiUtf8();
$de->getFlagEmojiUCode();    // "U+1F1E9 U+1F1EA"

$de->flag_colors;            // ['Black', 'Red', 'Gold']
$de->flag_colors_hex;        // ['#000000', '#DD0000', '#FFCE00']
$de->flag_colors_rgb;
$de->flag_colors_cmyk;
$de->flag_colors_hsl;
$de->flag_colors_pantone;
```

## Relations

```php
$de->region;                 // CountryRegion (Africa / Americas / Asia / Europe / Oceania)
$de->coordinates;            // CountryCoordinates — lat, lon, formatted variants
$de->geographical;           // CountryGeographical — country outline as GeoJSON
$de->extras;                 // CountryExtras — religions, intl. orgs, national sport, internet stats
```

## Query scopes

All upstream scopes continue to work under the new namespace:

| Scope | Example |
|---|---|
| `whereIso`, `whereIsoAlpha2`, `whereIsoAlpha3`, `whereIsoNumeric` | `Country::whereIso('DE')->first()` |
| `whereName`, `whereSlug` | `Country::whereName('Germany')->first()` |
| `whereCurrency` | `Country::whereCurrency('EUR')->get()` |
| `whereBorders` | `Country::whereBorders('FR')->get()` |
| `whereDomain` | `Country::whereDomain('.de')->first()` |
| `whereLanguages` | `Country::whereLanguages('de')->get()` |
| `wherePhoneCode` | `Country::wherePhoneCode('49')->first()` |
| `whereFlagColors` | `Country::whereFlagColors('Black')->get()` |
| `whereIndependenceDay` | `Country::whereIndependenceDay('1990-10-03')->first()` |
| `whereStatistics` | — various demographic filters |
| `whereWmo` | `Country::whereWmo('DL')->first()` |

## Global scopes

Two global scopes are applied to `Country`:

- **`is_visible`** — filters out countries marked `is_visible = false`. Disable with `Country::withoutGlobalScope('is_visible')` if you need hidden entries.
- **`translation`** — eager-loads translations for the current app locale + fallback locale. This is why `Country::all()->pluck('name')` is N+1-free: the relation is already hydrated.

## Translations (advanced)

If you want to work with translations beyond the single-locale helper:

```php
app()->setLocale('de');
Country::all()->pluck('name', 'iso_alpha_2');
// ['DE' => 'Deutschland', ...] — uses the global scope, no extra queries
```

Or access astrotomic's translate() directly:

```php
$de->translate('fr')?->name;   // "Allemagne"
$de->translations;             // HasMany relation to CountryTranslation
```
