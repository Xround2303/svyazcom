<?php

namespace Database\Factories;

use App\Models\ModelResident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelResidentFactory extends Factory
{
    protected $model = ModelResident::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "fio" => fake()->name(),
            "area" => fake()->numberBetween(50, 9999),
            "start_date" => fake()->date
        ];
    }
}
