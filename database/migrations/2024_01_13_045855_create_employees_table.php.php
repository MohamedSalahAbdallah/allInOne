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

            //name in english
            $table->string('name');
            //name in arabic
            $table->string('name_ar');
            //Employee's nid
            $table->string('nid');
            //Employee's personal image
            $table->string('personal_image')->nullable();
            ////Employee's date of birth
            $table->date('date_of_birth');
            //Employee's gender
            $table->string('gender');
            //Employee's nationality
            $table->string('nationality');
            //Employee's marital status
            $table->string('marital_status');
            ////Employee's religon
            $table->string('religion');
            //Employee's criminal case
            $table->string('criminal_case');
            //Employee's id card front
            $table->string('id_card_front');
            //Employee's id card back
            $table->string('id_card_back');
            ////Employee's country
            $table->string('country');
            //Employee's state
            $table->string('state');
            //Employee's address
            $table->string('address');
            //Employee's current country
            $table->string('current_country');
            //Employee's current state
            $table->string('current_state');
            //Employee's current address
            $table->string('current_address');
            // Employee's emaill
            $table->string('email')->unique();
            //Employee's phone number
            $table->string('phone')->unique();
            //Employee's password
            $table->string('password');
            //Employee's facebook link
            $table->string('facebook')->nullable();
            //Employee's linkedin link
            $table->string('linkedin')->nullable();
            //Employee's main language
            $table->string('main_language')->nullable();
            //Employee's secondary language
            $table->string('secondary_language')->nullable();
            //Employee's first skill
            $table->string('first_skill');
            //Employee's first skill duration
            $table->string('first_skill_duration');
            //Employee's training name
            $table->string('training_name')->nullable();
            //Employee's training duration
            $table->string('training_duration')->nullable();
            //Employee's training certificate
            $table->string('training_certificate')->nullable();
            //Employee's experience
            $table->text('experience');
            //Is employee perminant
            $table->boolean('is_permanent')->default(false);
            // Employee manager id
            $table->unsignedBigInteger('manager_id')->nullable();

            // job ID For the employee (foreign key)
            $table->unsignedBigInteger("job_id");

            $table->foreign("job_id")->references('id')->on('jobs');

            // emp job type
            $table->string('job_type')->nullable();
            //emp level
            $table->integer("level");
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


// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;
// use PharIo\Manifest\Email;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         // Schema::create('employees', function (Blueprint $table) {
//         //     $table->id();
//         //     $table->timestamps();

//         //     // Employee's first name
//         //     $table->string('first_name');

//         //     // Employee's last name
//         //     $table->string('last_name');

//         //     // Unique email address for the employee
//         //     $table->string('email')->unique()->email();

//         //     // Password for the employee (minimum length of 8 characters)
//         //     $table->string('password')->min(8);

//         //     // Unique phone number for the employee (11 digits)
//         //     $table->string('phone')->unique()->size(11);

//         //     // National ID number for the employee
//         //     $table->integer('nid');


//         //     // Image file path for the employee (optional)
//         //     $table->string('image')->nullable();

//         //     // Indicates if the employee is a permanent employee (true/false)
//         //     $table->boolean('permanent');

//         //     // Manager ID for the employee (foreign key)
//         //     $table->integer('manager_id')->nullable();

//         //     // job ID For the employee (foreign key)
//         //     $table->foreignId('job_id')->constrained('jobs');


//         // });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('employees');
//     }
// };
