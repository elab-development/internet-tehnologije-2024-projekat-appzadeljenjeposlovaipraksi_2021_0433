<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 1: Kreiranje tabele (Create Table)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompanije', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->string('adresa')->nullable();
            $table->string('grad')->nullable();
            $table->string('email')->unique();
            $table->string('telefon')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('aktivna')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompanije');
    }
};
