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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            //user_id, integer
            $table->integer('user_id');
            //nim, string
            $table->string('nim')->nullable();
            //gender, string
            $table->string('gender')->nullable();
            //address, text
            $table->text('address')->nullable();
            //phone, string
            $table->string('phone')->nullable();
            //photo, string
            $table->string('photo')->nullable();
            //birthdate, string
            $table->string('birthdate')->nullable();
            //city birth, string
            $table->string('city_birth')->nullable();
            //father name, string
            $table->string('father_name')->nullable();
            //mother name, string
            $table->string('mother_name')->nullable();
            //last education, string
            $table->string('last_education')->nullable();
            //admitted at, string
            $table->string('admitted_at')->nullable();
            //study program id, integer
            $table->integer('study_program_id')->nullable();
            //faculty id, integer
            $table->integer('faculty_id')->nullable();
            //blood type, string
            $table->string('blood_type')->nullable();
            //nationality, string
            $table->string('nationality')->nullable();
            //religion, string
            $table->string('religion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
