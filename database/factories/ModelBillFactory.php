<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\ModelBill;
use App\Models\ModelPeriod;
use App\Models\ModelResident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ModelBillFactory extends Factory
{
    protected $model = ModelBill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "resident_id" => ModelResident::factory(),
            "period_id" => ModelPeriod::all()->random()->id,
            "amount_rub" => fake()->numberBetween(0, 100000)
        ];
    }
}
