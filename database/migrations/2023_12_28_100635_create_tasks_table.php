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
            $table->string('description');
            $table->string('location');
            $table->string('file')->nullable();
            //status
            //start date
            $table->dateTime('starts_at');
            //end date
            $table->dateTime('ends_at');
            //start time
            $table->time('starts_time');
            //end time
            $table->time("end_time");
            //department id
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")->references('id')->on('departments');
            $table->unsignedBigInteger("sub_department_id");
            $table->foreign("sub_department_id")->references('id')->on('sub_departments');
            //emp id
            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id")->references('id')->on('employees');

            $table->unsignedBigInteger("site_id");
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
