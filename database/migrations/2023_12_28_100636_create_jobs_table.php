<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a new table named 'jobs' in the database schema
        Schema::create('jobs', function (Blueprint $table) {
            // Add an 'id' column to the table
            $table->id();
            // Add 'created_at' and 'updated_at' columns to the table to track timestamps
            $table->timestamps();
            // Add a 'job_code' column to store the job code
            $table->string('job_code');
            // Add a 'name' column to store the job name
            $table->string('name');
            // Add a 'description' column to store the job description
            $table->string('description');
            // Add a 'department_id' column to store the ID of the department associated with the job
            $table->unsignedBigInteger("department_id");
            // Create a foreign key constraint on 'department_id' column referencing the 'id' column of the 'departments' table
            $table->foreign("department_id")->references('id')->on('departments');
            // Add a 'sub_department_id' column to store the ID of the sub-department associated with the job
            $table->unsignedBigInteger("sub_department_id");
            // Create a foreign key constraint on 'sub_department_id' column referencing the 'id' column of the 'sub_departments' table
            $table->foreign("sub_department_id")->references('id')->on('sub_departments');
            // Add a 'status' column to store the status of the job
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
