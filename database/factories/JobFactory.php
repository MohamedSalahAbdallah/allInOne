<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
            'job_code' => $this->faker->unique()->numberBetween(0, 1000),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'department_id' => function () {
                return \App\Models\Department::factory()->create()->id;
            },
            'sub_department_id' => function () {
                return \App\Models\SubDepartment::factory()->create()->id;
            },
            'status' => $this->faker->randomElement(['active', 'inactive']),

        ];
    }
}
