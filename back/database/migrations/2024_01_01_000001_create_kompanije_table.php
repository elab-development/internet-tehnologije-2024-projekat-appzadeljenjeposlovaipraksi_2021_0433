<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompanije', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->string('grad')->nullable();
            $table->boolean('aktivna')->default(true);
            $table->integer('broj_zaposlenih')->nullable();
            $table->string('telefon')->unique()->nullable();
            $table->string('email')->unique()->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompanije');
    }
};
