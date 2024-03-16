<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubDepartment>
 */
class SubDepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'sub_department_code' => $this->faker->numberBetween(0, 1000),
            'department_id' => function () {
                return Department::factory()->create()->id;
            } ,

        ];
    }
}
