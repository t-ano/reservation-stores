<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('1day', '3month')->format('Y-m-d');
        $term = $this->faker->biasedNumberBetween('1', '3');
        $end = date('Y-m-d', strtotime("{$start} +{$term} week"));
        return [
            'name' => $this->faker->word() . 'プラン',
            'start' => $start,
            'end' => $end,
            'price' => $this->faker->biasedNumberBetween('5000', '30000')
        ];
    }
}
