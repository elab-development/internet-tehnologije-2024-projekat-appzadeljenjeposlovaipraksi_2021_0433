<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prijave', function (Blueprint $table) {
            $table->date('datum_prijave')->nullable()->after('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('prijave', function (Blueprint $table) {
            $table->dropColumn('datum_prijave');
        });
    }
};
