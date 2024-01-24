<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            // 'first_name' => $this->faker->firstName,
            // 'last_name' => $this->faker->lastName,
            // 'nid' => $this->faker->unique()->randomNumber,
            // 'job_id' => $this->faker->numberBetween(1,4),
            // 'image' => $this->faker->imageUrl,
            // 'permanent' => $this->faker->boolean,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'phone' => $this->faker->phoneNumber,
            // 'password' => bcrypt('password'), // or use a custom logic to generate a password
            // 'manager_id' => $this->faker->numberBetween(1,4),
            // 'gender'=>$this->faker->word(),

            ];
    }
}
