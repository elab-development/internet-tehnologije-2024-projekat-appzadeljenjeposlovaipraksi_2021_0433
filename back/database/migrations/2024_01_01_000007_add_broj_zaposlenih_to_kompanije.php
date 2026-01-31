<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('kompanije', 'broj_zaposlenih')) {
            Schema::table('kompanije', function (Blueprint $table) {
                $table->integer('broj_zaposlenih')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('kompanije', 'broj_zaposlenih')) {
            Schema::table('kompanije', function (Blueprint $table) {
                $table->dropColumn('broj_zaposlenih');
            });
        }
    }
};
