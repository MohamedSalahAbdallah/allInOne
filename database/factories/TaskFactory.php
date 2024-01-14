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
            'location' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'assigned_by' => $this->faker->numberBetween(1, 10),
            'assigned_to' => $this->faker->numberBetween(1, 10),
            'file'=>$this->faker->filePath(),
        ];
    }
}
