<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 4: Brisanje kolone (Drop Column)
 * Uklanjamo kolonu 'trajanje' iz oglasa i dodajemo specificnije kolone
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('oglasi', function (Blueprint $table) {
            $table->dropColumn('trajanje');
        });
        
        Schema::table('oglasi', function (Blueprint $table) {
            $table->integer('trajanje_meseci')->nullable()->after('zahtevi');
            $table->date('datum_pocetka')->nullable()->after('trajanje_meseci');
        });
    }

    public function down(): void
    {
        Schema::table('oglasi', function (Blueprint $table) {
            $table->dropColumn(['trajanje_meseci', 'datum_pocetka']);
        });
        
        Schema::table('oglasi', function (Blueprint $table) {
            $table->string('trajanje')->nullable()->after('zahtevi');
        });
    }
};
