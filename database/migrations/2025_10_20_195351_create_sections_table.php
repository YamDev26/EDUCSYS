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
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('debut');
            $table->string('fin');
            $table->enum('status', [0, 1, 2])->default(0);
            $table->enum('order', [1, 2, 3]);
            $table->unsignedBigInteger('parametre_id');
            $table->unsignedBigInteger('school_year_id');
            $table->timestamps();
            $table->foreign('parametre_id')->references('id')->on('parametres')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
