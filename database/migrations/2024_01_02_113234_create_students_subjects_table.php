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
        Schema::create('students_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_id')->nullable();
            $table->unsignedBigInteger('subjects_id')->nullable();
            $table->timestamps();

            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_subjects');
    }
};
