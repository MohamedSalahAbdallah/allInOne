<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use Illuminate\Database\Seeder;

use App\Models\Task;
use App\Models\group;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Call the factory methods to create dummy data
       Employee::factory()->count(10)->create();
       Task::factory()->count(20)->create();
       group::factory()->count(5)->create();
    }
}
