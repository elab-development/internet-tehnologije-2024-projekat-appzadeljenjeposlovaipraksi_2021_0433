<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            // U MySQL ne može default na text, zato samo menjamo nullable
            $table->text('opis')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('kompanije', function (Blueprint $table) {
            $table->text('opis')->nullable()->change();
        });
    }
};
