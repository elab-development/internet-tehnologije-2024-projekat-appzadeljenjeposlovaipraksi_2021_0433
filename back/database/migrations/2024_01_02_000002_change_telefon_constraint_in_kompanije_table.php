<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tip migracije 3: Izmena postojeće kolone (dodavanje ograničenja unique)
     */
    public function up(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->string('telefon')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->dropUnique('kompanije_telefon_unique');
        });
    }
};
