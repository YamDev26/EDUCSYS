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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('sexe',['F','M']);
            $table->string('date_birth')->nullable();
            $table->string('birth')->nullable();
            $table->string('residence')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->unsignedBigInteger('school_year_id');
            $table->unsignedBigInteger('nationalitie_id');
            $table->unsignedBigInteger('student_parent_id');
            $table->timestamps();

            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('nationalitie_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('student_parent_id')->references('id')->on('student_parents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
