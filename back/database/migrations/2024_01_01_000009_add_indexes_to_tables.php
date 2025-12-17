<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 5: Dodavanje indeksa i ogranicenja (Add Index/Constraint)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('oglasi', function (Blueprint $table) {
            // Dodavanje indeksa za brze pretrage
            $table->index('tip_posla');
            $table->index('aktivan');
            $table->index('lokacija');
        });

        Schema::table('kompanije', function (Blueprint $table) {
            $table->index('grad');
            $table->index('aktivna');
        });
    }

    public function down(): void
    {
        Schema::table('oglasi', function (Blueprint $table) {
            $table->dropIndex(['tip_posla']);
            $table->dropIndex(['aktivan']);
            $table->dropIndex(['lokacija']);
        });

        Schema::table('kompanije', function (Blueprint $table) {
            $table->dropIndex(['grad']);
            $table->dropIndex(['aktivna']);
        });
    }
};
