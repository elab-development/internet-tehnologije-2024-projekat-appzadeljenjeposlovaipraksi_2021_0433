<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tip migracije 2: Dodavanje kolone (datum_prijave)
     */
    public function up(): void
    {
        Schema::table('prijave', function (Blueprint $table) {
            $table->dateTime('datum_prijave')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prijave', function (Blueprint $table) {
            $table->dropColumn('datum_prijave');
        });
    }
};
