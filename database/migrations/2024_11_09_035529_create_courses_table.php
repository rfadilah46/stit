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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            //name
            $table->string('name');
            //description
            $table->text('description')->nullable();
            //sks 
            $table->integer('sks');
            //professor id
            $table->integer('professor_id')->nullable();
            //assistant professor
            $table->string('assistant_professor')->nullable();
            //study program id
            $table->integer('study_program_id')->nullable();
            //semester
            $table->integer('semester')->nullable();
            //faculty_id, integer
            $table->integer('faculty_id')->nullabe();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
