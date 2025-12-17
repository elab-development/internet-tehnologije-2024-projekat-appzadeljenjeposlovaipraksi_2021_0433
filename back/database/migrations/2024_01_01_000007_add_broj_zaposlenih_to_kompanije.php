<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 2: Dodavanje kolone (Add Column)
 * Dodajemo kolonu 'broj_zaposlenih' u tabelu kompanije
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->integer('broj_zaposlenih')->nullable()->after('website');
        });
    }

    public function down(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->dropColumn('broj_zaposlenih');
        });
    }
};
