<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->text('zahtevi')->nullable();
            $table->boolean('aktivan')->default(true);
            $table->foreignId('kompanija_id')->constrained('kompanije')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oglasi');
    }
};
