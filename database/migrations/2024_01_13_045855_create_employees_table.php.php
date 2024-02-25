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

            $table->string('address');
            $table->string('asylumCard');
            $table->string('certificate');
            $table->string('country');
            $table->string('current_address');
            $table->string('current_country');
            $table->string('current_state');
            $table->string('date_of_birth');
            $table->string('email');
            $table->string('entryVisa');
            $table->string('facebook');
            $table->string('gender');
            $table->string('health');
            $table->string('instagram');
            $table->string('integratedServices');
            $table->string('landLine');
            $table->string('linkedIn');
            $table->string('main_language');
            $table->string('marital_status');
            $table->string('militaryCertificate');
            $table->string('militaryStatus');
            $table->string('name');
            $table->string('name_ar');
            $table->string('passport');
            $table->string('phone');
            $table->string('religion');
            $table->string('secondary_language');
            $table->string('state');
            $table->string('id_nationalCard_back');
            $table->string('id_nationalCard_front');
            $table->string('nationalId');
            $table->string('nationality');
            $table->string('password');
            //Is employee active
            $table->boolean('is_active')->default(false);
            //Is employee permanent
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
