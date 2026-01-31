<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('oglasi', function (Blueprint $table) {
            if (Schema::hasColumn('oglasi', 'tip_posla')) {
                $table->index('tip_posla');
            }
            if (Schema::hasColumn('oglasi', 'aktivan')) {
                $table->index('aktivan');
            }
            if (Schema::hasColumn('oglasi', 'lokacija')) {
                $table->index('lokacija');
            }
        });

        Schema::table('kompanije', function (Blueprint $table) {
            if (Schema::hasColumn('kompanije', 'grad')) {
                $table->index('grad');
            }
            if (Schema::hasColumn('kompanije', 'aktivna')) {
                $table->index('aktivna');
            }
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
