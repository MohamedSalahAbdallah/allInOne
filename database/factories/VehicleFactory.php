<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "chassis_number"=>$this->faker->numberBetween(1999,2024),
            "engine_number"=>$this->faker->numberBetween(1999,2024),
            "plate_number"=>$this->faker->numberBetween(1999,2024),
            "vehicle_type"=>$this->faker->name(),
            "vehicle_brand"=>$this->faker->name(),
            "vehicle_year"=>$this->faker->numberBetween(1999,2024),
            "vehicle_color"=>$this->faker->randomElement(['red','green','blue','black']),
        ];
    }
}
