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
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            //name
            $table->string('name');
            //description
            $table->text('description')->nullable();
            //faculty_id
            $table->integer('faculty_id')->nullable();
            //head of study program
            $table->string('head_of_study_program')->nullable();
            //study program code
            $table->string('study_program_code')->nullable();
            //study program level
            $table->string('study_program_level')->nullable();
            //study program type
            $table->string('study_program_type')->nullable();
            //study program duration
            $table->integer('study_program_duration')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};
