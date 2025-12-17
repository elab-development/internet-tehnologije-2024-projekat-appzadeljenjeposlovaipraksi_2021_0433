<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 1: Kreiranje tabele sa vise spoljnih kljuceva
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prijave', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('oglas_id');
            $table->text('motivaciono_pismo')->nullable();
            $table->string('cv_path')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('napomena')->nullable();
            $table->timestamps();

            // Spoljni kljucevi
            $table->foreign('korisnik_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('oglas_id')
                  ->references('id')
                  ->on('oglasi')
                  ->onDelete('cascade');

            // Migration Type 4: Postavljanje dodatnih ogranicenja (Unique Constraint)
            // Jedan korisnik moze da se prijavi samo jednom na isti oglas
            $table->unique(['korisnik_id', 'oglas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prijave');
    }
};
