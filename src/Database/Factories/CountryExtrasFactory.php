<?php

namespace Aaix\LaravelCountries\Database\Factories;

use Aaix\LaravelCountries\Models\CountryExtras;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CountryExtrasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = CountryExtras::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'lc_country_id' => fn () => CountryFactory::new()->create()->id,
            'national_sport' => fake()->word(),
            'cybersecurity_agency' => fake()->word(),

            'popular_technologies' => fake()->words(),
            'internet' => fake()->words(),
            'religions' => fake()->words(),
            'international_organizations' => fake()->words(),
        ];
    }
}
