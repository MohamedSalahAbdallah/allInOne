<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\branch;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

use App\Models\Task;
use App\Models\group;
use App\Models\Job;
use App\Models\order;
use App\Models\UserRequest;
use App\Models\sector;
use App\Models\SubDepartment;
use App\Models\supplier;
use App\Models\User;
use App\Models\vehicle;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Call the factory methods to create dummy data
        Department::factory()->count(5)->create();
        SubDepartment::factory()->count(5)->create();
        Job::factory()->count(5)->create();
        User::factory()->count(20)->create();
        Employee::factory()->count(10)->create();
        UserRequest::factory()->count(5)->create();
        //    group::factory()->count(5)->create();
        //
        sector::factory()->count(10)->create();
        supplier::factory()->count(10)->create();
        Task::factory()->count(20)->create();
        order::factory()->count(10)->create();
        branch::factory()->count(10)->create();
        vehicle::factory()->count(10)->create();
    }
}
