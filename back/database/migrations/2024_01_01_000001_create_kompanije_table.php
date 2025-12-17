<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tip migracije 1: Kreiranje tabele
     */
    public function up(): void
    {
        Schema::create('kompanije', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->string('adresa')->nullable();
            $table->string('grad')->nullable();
            $table->string('email')->unique();
            $table->string('telefon')->nullable();
            $table->string('website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompanije');
    }
};
