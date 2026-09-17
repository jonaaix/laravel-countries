<?php

namespace Aaix\LaravelCountries\Database\Factories;

use Aaix\LaravelCountries\Models\CountryGeographical;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CountryGeographicalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = CountryGeographical::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'lc_country_id' => fn () => CountryFactory::new()->create()->id,
            'type' => 'FeatureCollection',
            'features_type' => 'Feature',
            'properties' => '{"cca2": "{'.fake()->languageCode().'}"}',
            'geometry' => '',
        ];
    }
}
