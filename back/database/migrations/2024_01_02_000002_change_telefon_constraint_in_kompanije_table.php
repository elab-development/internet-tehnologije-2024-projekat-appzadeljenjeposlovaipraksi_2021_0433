<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Provera da li postoji indeks za 'telefon'
        $indexExists = DB::select("SHOW INDEX FROM kompanije WHERE Key_name = 'kompanije_telefon_unique'");

        if (empty($indexExists)) {
            Schema::table('kompanije', function (Blueprint $table) {
                $table->string('telefon')->unique()->nullable()->change();
            });
        } else {
            // Samo promeni kolonu ako indeks već postoji
            Schema::table('kompanije', function (Blueprint $table) {
                $table->string('telefon')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Provera da li indeks postoji pre nego što ga izbrišemo
        $indexExists = DB::select("SHOW INDEX FROM kompanije WHERE Key_name = 'kompanije_telefon_unique'");

        if (!empty($indexExists)) {
            Schema::table('kompanije', function (Blueprint $table) {
                $table->dropUnique('kompanije_telefon_unique');
            });
        }
    }
};
