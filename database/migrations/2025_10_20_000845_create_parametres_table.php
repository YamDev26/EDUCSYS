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
        Schema::create('parametres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle')->unique();
            $table->string('montant')->nullable();
            $table->enum('etat', [1, 2, 3, 4]); // 1 => Plein, 2 => Partiel, 3 => Trimestre, 4 => Autres
            $table->string('autres')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
