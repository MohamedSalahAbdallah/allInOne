<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeTraining>
 */
class EmployeeTrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'duration'=>$this->faker->randomNumber(2),
            'certificate'=>$this->faker->imageUrl,
            'employee_id'=> $this->faker->numberBetween(1,9),
        ];
    }
}
