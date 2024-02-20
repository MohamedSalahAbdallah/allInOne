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
            $table->string('nid')->nullable();
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
            $table->string('id_card_front')->nullable();
            //Employee's id card back
            $table->string('id_card_back')->nullable();
            //Employee's passport
            $table->string('passport_image')->nullable();
            //Employee's passport number
            $table->string('passport_number')->nullable();
            //Employee's location
            $table->string('location')->nullable();
            //Employee's health
            $table->string('health')->nullable();
            //Employee's military service
            $table->string('military_service')->nullable();
            ////Employee's country
            $table->string('country')->nullable();
            //Employee's state
            $table->string('state')->nullable();
            //Employee's address
            $table->string('address')->nullable();
            //Employee's current country
            $table->string('current_country');
            //Employee's current state
            $table->string('current_state');
            //Employee's current address
            $table->string('current_address');
            // Employee's emaill
            $table->string('email')->unique();
            //Employee's password
            $table->string('password');
            //Employee's phone number
            $table->string('phone')->unique();
            //Employee's home number
            $table->string('home_number')->nullable();
            //Employee's social
            $table->string('social_media')->nullable();
            $table->string('social_link')->nullable();
            //Employee's main language
            $table->string('main_language')->nullable();
            //Employee's secondary language
            $table->string('secondary_language')->nullable();
            //Employee's first skill

            //Employee's experience
            $table->text('experience')->nullable();
            //employees area of expertise
            $table->text('area_of_expertise')->nullable();
            //Employee's experience duration
            $table->string('experience_duration')->nullable();
            //Is employee active
            $table->boolean('is_active')->default(false);
            //Is employee online
            $table->boolean('is_online')->default(false);
            //Is employee perminant
            $table->boolean('is_permanent')->default(false);
            // Employee manager id
            $table->unsignedBigInteger('manager_id')->nullable();

            // job ID For the employee (foreign key)
            $table->unsignedBigInteger("job_id")->nullable();

            $table->foreign("job_id")->references('id')->on('jobs');

            // emp job type
            $table->string('job_type')->nullable();
            //emp level
            $table->integer("level")->nullable();
      });
    }
    // nameArabic: "",
    // nameEnglish: "",
    // date: "",
    // type: "",
    // religion: "",
    // nationality: "",
    // photoPersonal: "",
    // newCountry: "",
    // newState: "",
    // newAddress: "",
    // addressGoogle: "",
    // phoneNumber: "",
    // homeNumber: "",
    // email: "",
    // password: "",
    // social: "",
    // mainLanguage: "",
    // secondLanguage: "",
    // oneSkill: "",
    // durationSkill: "",
    // secSkill: "",
    // durationSkillTwo: "",
    // thirdSkill: "",
    // durationSkillthird: "",
    // photoCertificates: "",
    // trainingNameOne: "",
    // trainingTimeOne: "",
    // PhotosTrainingCertificateOne: "",
    // trainingNameSec: "",
    // trainingTimeSec: "",
    // PhotosTrainingCertificateSec: "",
    // trainingNameThird: "",
    // trainingTimeThird: "",
    // PhotosTrainingCertificateThird: "",
    // experience: "",
    // areaExpertis: "",
    // howLongExpertise: "",

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
