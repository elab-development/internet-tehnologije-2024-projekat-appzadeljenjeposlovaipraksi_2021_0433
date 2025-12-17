<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 3: Izmena postojece kolone (Modify Column)
 * Menjamo tip kolone 'opis' u kompanijama iz nullable text u required text
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->text('opis')->nullable(false)->default('')->change();
        });
    }

    public function down(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->text('opis')->nullable()->change();
        });
    }
};
