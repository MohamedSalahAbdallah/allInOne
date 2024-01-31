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
            // 'name' => $this->faker->Name,
            // 'name_ar'=>$this->faker->name,
            // 'nid'=>$this->faker->randomNumber(8),
            // 'personal_image'=>$this->faker->image,
            // 'date_of_birth'=>$this->faker->date,
            // 'gender'=>$this->faker->word,
            // 'nationality'=>$this->faker->country,
            // 'marital_status'=>$this->faker->word,
            ];
    }
}
