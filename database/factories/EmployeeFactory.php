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
            'name' => $this->faker->name,
            'name_ar' => $this->faker->name,
            'nid' => $this->faker->unique()->randomNumber,
            'personal_image' => $this->faker->imageUrl(),
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'nationality' => $this->faker->country,
            'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced']),
            'religion' => $this->faker->word,
            'criminal_case' => $this->faker->word,
            'id_card_front' => $this->faker->imageUrl(),
            'id_card_back' => $this->faker->imageUrl(),
            'country' => $this->faker->country,
            'state' => $this->faker->state,
            'address' => $this->faker->address,
            'current_country' => $this->faker->country,
            'current_state' => $this->faker->state,
            'current_address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => bcrypt('password'), // Default password, you may want to change this
            // 'facebook' => $this->faker->url,
            // 'linkedin' => $this->faker->url,
            'main_language' => $this->faker->languageCode,
            'secondary_language' => $this->faker->languageCode,
            // 'first_skill' => $this->faker->word,
            // 'first_skill_duration' => $this->faker->word,
            // 'training_name' => $this->faker->word,
            // 'training_duration' => $this->faker->word,
            // 'training_certificate' => $this->faker->word,
            'experience' => $this->faker->paragraph,
            'is_permanent' => $this->faker->boolean,
            'manager_id' => null, // You may want to adjust this depending on your logic
            'job_id' => function () {
                return \App\Models\Job::factory()->create()->id;
            },
            'job_type' => $this->faker->word,
            'level' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean,
            'is_online' => $this->faker->boolean,

            ];
    }
}
