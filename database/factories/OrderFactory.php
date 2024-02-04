<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => $this->faker->word,
            'type' => $this->faker->word,
            'style' => $this->faker->word,
            'count' => $this->faker->numberBetween(1, 100),
            'gender' => $this->faker->numberBetween(0, 1),
            'priority' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(100, 1000),
            'iron' => $this->faker->boolean,
            'rafa' => $this->faker->boolean,
            'wash' => $this->faker->boolean,
            'tincture' => $this->faker->boolean,
            'task_id' => function () {
                return \App\Models\Task::factory()->create()->id;
            },
        ];
    }
}
