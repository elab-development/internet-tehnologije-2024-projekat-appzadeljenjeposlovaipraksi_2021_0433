<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 1: Kreiranje tabele sa spoljnim kljucevima
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oglasi', function (Blueprint $table) {
            $table->id();
            $table->string('naslov');
            $table->text('opis');
            $table->string('lokacija')->nullable();
            $table->enum('tip_posla', ['praksa', 'posao', 'part-time'])->default('posao');
            $table->decimal('plata', 10, 2)->nullable();
            $table->string('trajanje')->nullable();
            $table->text('zahtevi')->nullable();
            $table->unsignedBigInteger('kompanija_id');
            $table->boolean('aktivan')->default(true);
            $table->date('rok_prijave')->nullable();
            $table->timestamps();

            // Spoljni kljuc
            $table->foreign('kompanija_id')
                  ->references('id')
                  ->on('kompanije')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oglasi');
    }
};
