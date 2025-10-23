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
        Schema::create('payements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('debut')->nullable();
            $table->string('fin')->nullable();
            $table->enum('status', [0, 1, 2])->default(1);
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('parametre_id');
            $table->unsignedBigInteger('school_year_id');
            $table->unsignedBigInteger('centre_student_id');
            $table->timestamps();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('parametre_id')->references('id')->on('parametres')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('centre_student_id')->references('id')->on('centre_students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};
