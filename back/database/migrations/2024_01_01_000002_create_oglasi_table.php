<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tip migracije 1: Kreiranje tabele sa spoljnim ključem
     */
    public function up(): void
    {
        Schema::create('oglasi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('naslov');
            $table->text('opis');
            $table->string('lokacija')->nullable();
            $table->enum('tip_posla', ['praksa', 'posao', 'part-time'])->default('posao');
            $table->decimal('plata', 10, 2)->nullable();
            $table->text('zahtevi')->nullable();
            $table->foreignId('kompanija');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oglasi');
    }
};
