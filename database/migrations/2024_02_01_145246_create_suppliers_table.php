<?php

use App\Models\branch;
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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            //Foreign key sector ID.
            $table->unsignedBigInteger("sector_id");
            $table->foreign("sector_id")->references("id")->on("sectors");
            //Trade license.
            $table->string("trade_license");
            //Registry Headquarters
            $table->string("registry_office");
            //Trade license number. uniqe
            $table->string("trade_license_number")->unique();
            //Directorate
            $table->string("directorate");
            //owner Director Name
            $table->string("director_name")->nullable();
            //owner Director phone number
            $table->string("phone_number")->nullable()->unique();
            //owner Director email
            $table->string("email")->nullable()->unique();
            // sales manager name
            $table->string("sales_manager_name")->nullable();
            // sales manager phone
            $table->string("sales_manager_phone")->nullable();
            // Company number
            $table->string("company_number")->nullable();
            //Fax number
            $table->string("fax_number")->nullable();
           //Headquarters address
            $table->string("headquarters_address")->nullable();
            //Company email.
            $table->string("company_email")->nullable();
           //Manufacturing license
            $table->string("manufacturing_license")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }

};
