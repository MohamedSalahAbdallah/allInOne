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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('description')->nullable();
            //project location
            $table->string('location')->nullable();
            //file
            $table->string('file')->nullable();
            //status
            $table->string('status')->nullable();
            //
            //start date
            $table->dateTime('starts_at')->nullable();
            //end date
            $table->dateTime('ends_at')->nullable();
            //start time
            $table->time('starts_time')->nullable();
            //end time
            $table->time("end_time")->nullable();
            //department id
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")->references('id')->on('departments');
            $table->unsignedBigInteger("sub_department_id");
            $table->foreign("sub_department_id")->references('id')->on('sub_departments');

            //user id
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references('id')->on('users');
            //Employee ID foreign key from employee table.
            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id")->references('id')->on('employees');
            //site id
            $table->unsignedBigInteger("site_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
