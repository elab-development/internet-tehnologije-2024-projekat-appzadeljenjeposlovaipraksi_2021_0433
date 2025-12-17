<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration Type 2: Dodavanje kolone (Add Column) - dodavanje spoljnog kljuca
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('kompanija_id')->nullable()->after('tip_korisnika');
            
            // Migration Type 5: Dodavanje spoljnih kljuceva (Foreign Key)
            $table->foreign('kompanija_id')
                  ->references('id')
                  ->on('kompanije')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kompanija_id']);
            $table->dropColumn('kompanija_id');
        });
    }
};
