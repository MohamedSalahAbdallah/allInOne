<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'sector_id'=>$this->faker->numberBetween(1,10),
            'trade_license'=>$this->faker->name,
            'registry_office'=>$this->faker->name,
            "trade_license_number"=>$this->faker->unique()->numberBetween(0,5000),
            "directorate"=>$this->faker->name(),
            "director_name"=>$this->faker->name(),
            "phone_number"=>$this->faker->unique()->phoneNumber(),
            "email"=>$this->faker->unique()->email(),
            "sales_manager_name"=>$this->faker->name(),
            "sales_manager_phone"=>$this->faker->unique()->phoneNumber(),
            "company_number"=>$this->faker->numberBetween(1,10),
            "fax_number"=>$this->faker->numberBetween(1,10),
            "headquarters_address"=>$this->faker->word,
            "company_email"=>$this->faker->email(),
            "manufacturing_license"=>$this->faker->word,
        ];
    }
}
