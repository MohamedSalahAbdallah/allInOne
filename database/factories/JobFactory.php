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
            'name' => $this->faker->jobTitle,
            'description' => $this->faker->sentence,
            'sub_department_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
