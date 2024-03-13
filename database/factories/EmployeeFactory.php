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
            'address' => $this->faker->address,
        'asylumCard' => $this->faker->imageUrl(),
        'certificate' => $this->faker->imageUrl(),
        'country' => $this->faker->country,
        'current_address' => $this->faker->address,
        'current_country' => $this->faker->country,
        'current_state' => $this->faker->state,
        'date_of_birth' => $this->faker->date,
        'email' => $this->faker->unique()->safeEmail,
        'entryVisa' => $this->faker->word,
        // 'facebook' => $this->faker->url,
        'gender' => $this->faker->randomElement(['male', 'female']),
        'health' => $this->faker->word,
        // 'instagram' => $this->faker->url,
        'integratedServices' => $this->faker->imageUrl(),
        'landLine' => $this->faker->phoneNumber,
        // 'linkedIn' => $this->faker->url,
        'main_language' => $this->faker->languageCode,
        'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced']),
        'militaryCertificate' => $this->faker->imageUrl(),
        'militaryStatus' => $this->faker->word,
        'name' => $this->faker->name,
        'name_ar' => $this->faker->name,
        'passport' => $this->faker->imageUrl(),
        'phone' => $this->faker->phoneNumber,
        'religion' => $this->faker->word,
        'secondary_language' => $this->faker->languageCode,
        'state' => $this->faker->state,
        'id_nationalCard_back' => $this->faker->imageUrl(),
        'id_nationalCard_front' => $this->faker->imageUrl(),
        'nationalId' => $this->faker->word,
        'nationality' => $this->faker->country,
        'criminalRecord' => $this->faker->imageUrl(),
        'password' => bcrypt('password'),
            'is_permanent' => $this->faker->boolean,
            'manager_id' => null, // You may want to adjust this depending on your logic
            'job_id' => function () {
                return \App\Models\Job::factory()->create()->id;
            },
            'job_type' => $this->faker->word,
            'level' => $this->faker->numberBetween(1, 10),

            ];
    }
}
