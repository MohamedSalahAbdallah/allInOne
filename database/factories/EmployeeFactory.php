<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'nid' => $this->faker->unique()->randomNumber(9),
            'position' => $this->faker->jobTitle,
            'image' => $this->faker->imageUrl(),
            'permanent' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => bcrypt('password'), // You can replace this with your own logic for generating passwords
            'manager_id' => null,
        ];
    }
}
