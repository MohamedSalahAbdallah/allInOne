<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PharIo\Manifest\Email;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Employee's first name
            $table->string('first_name');

            // Employee's last name
            $table->string('last_name');

            // Unique email address for the employee
            $table->string('email')->unique()->email();

            // Password for the employee (minimum length of 8 characters)
            $table->string('password')->min(8);

            // Unique phone number for the employee (11 digits)
            $table->string('phone')->unique()->size(11);

            // National ID number for the employee
            $table->integer('nid');

            // Position/title of the employee
            $table->string('position');

            // Image file path for the employee (optional)
            $table->string('image')->nullable();

            // Indicates if the employee is a permanent employee (true/false)
            $table->boolean('permanent');

            // Manager ID for the employee (foreign key)
            $table->integer('manager_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
