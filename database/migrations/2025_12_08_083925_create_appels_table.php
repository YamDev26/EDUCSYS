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
        Schema::create('appels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('created');
            $table->enum('period', ['A','B']);
            $table->unsignedBigInteger('hourlie_id');
            $table->unsignedBigInteger('centre_student_id');
            $table->foreign('hourlie_id')->references('id')->on('hourlies')->onDelete('cascade');
            $table->foreign('centre_student_id')->references('id')->on('centre_students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appels');
    }
};
