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
        Schema::create('centre_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('classe');
            $table->enum('doublant', ['oui','non']);
            $table->enum('status', [0, 1])->default(1);
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('centre_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('school_year_id');
            $table->unsignedBigInteger('origin_school_id');
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('origin_school_id')->references('id')->on('origin_schools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centre_students');
    }
};
