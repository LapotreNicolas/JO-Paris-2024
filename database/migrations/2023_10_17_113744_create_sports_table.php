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
        Schema::create('sports', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable(false);
            $table->string('description');
            $table->integer('annee_ajout')->default(2024)->nullable(false);
            $table->integer('nb_disciplines')->default(1)->nullable(false);
            $table->integer('nb_epreuves')->default(1)->nullable(false);
            $table->datetime('date_debut')->nullable(false);
            $table->datetime('date_fin')->nullable(false);
            $table->string('url_media')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports');
    }
};
