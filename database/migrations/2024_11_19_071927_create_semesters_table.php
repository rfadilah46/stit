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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            //name
            $table->string('name');
            //ganjil or genap (in english)
            $table->enum('type', ['odd', 'even']);
            //start_date
            $table->date('start_date');
            //end_date
            $table->date('end_date');
            //year
            $table->year('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
