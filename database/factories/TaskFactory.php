<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'location' => $this->faker->city,
            'file' => $this->faker->word . '.txt',
            'status' => $this->faker->randomElement(['pending', 'completed', 'in_progress']),
            'starts_at' => $this->faker->dateTimeThisMonth,
            'ends_at' => $this->faker->dateTimeThisMonth,
            'starts_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'department_id' => function () {
                return \App\Models\Department::factory()->create()->id;
            },
            'sub_department_id' => function () {
                return \App\Models\SubDepartment::factory()->create()->id;
            },
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'site_id' => null, // Add logic for generating site_id if needed
            'employee_id' => function () {
                return \App\Models\Employee::factory()->create()->id;
            },
        ];
    }
}
