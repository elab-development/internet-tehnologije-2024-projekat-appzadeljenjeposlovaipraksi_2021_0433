<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tip migracije 2: Dodavanje kolone
     */
    public function up(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->dropColumn('logo');
        });
    }
};
