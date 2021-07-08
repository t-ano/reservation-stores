<?php

namespace Database\Factories;

use App\Models\Reserve;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReserveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reserve::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer' => $this->faker->unique()->numberBetween(1, 100),
            'shop' => $this->faker->numberBetween(1, 10),
            'plan' => $this->faker->numberBetween(1, 30),
            'datetime' => $this->faker->dateTimeBetween('-3month', 'now'),
            'payment' => $this->faker->randomElement([true, false])
        ];
    }
}
