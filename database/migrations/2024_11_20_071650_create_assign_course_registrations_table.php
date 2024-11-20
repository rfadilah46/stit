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
        Schema::create('assign_course_registrations', function (Blueprint $table) {
            $table->id();
            //course_id, foreign key ke courses
            $table->foreignId('course_id')->constrained('courses');
            //opened_at
            $table->date('opened_at')->nullable();
            //closed_at
            $table->date('closed_at')->nullable();
            //status, open, closed
            $table->enum('status', ['open', 'closed'])->default('open');
            //semester_id, foreign key ke semesters
            $table->foreignId('semester_id')->constrained('semesters')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_course_registrations');
    }
};
