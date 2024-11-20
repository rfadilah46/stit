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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            //name
            $table->string('name');
            //description
            $table->text('description')->nullable();
            //amount
            $table->integer('amount');
            //status, paid, unpaid
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            //user_id, foreign key ke users
            $table->foreignId('user_id')->constrained('users');
            //payment_evidence, string
            $table->string('payment_evidence')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
