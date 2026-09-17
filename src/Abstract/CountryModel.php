<?php

namespace Aaix\LaravelCountries\Abstract;

use Aaix\LaravelCountries\Models\Concerns\HasConfigs;
use Illuminate\Database\Eloquent\Model;

abstract class CountryModel extends Model
{
    use HasConfigs;

    /**
     * @property-read string $localeKey
     */
    public string $localeKey;

    /**
     * Set the locale key and initialize the model.
     */
    public function __construct(array $attributes = [])
    {
        $this->localeKey = $this->getConfigLocaleKey();

        parent::__construct($attributes);
    }
}
