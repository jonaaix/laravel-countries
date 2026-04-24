<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('lc_countries', function (Blueprint $table) {
            $table->string('native_name')
                ->nullable()
                ->after('official_name')
                ->comment("The country's name in its own primary language (e.g. Deutschland, 日本).");
        });
    }

    public function down(): void
    {
        Schema::table('lc_countries', function (Blueprint $table) {
            $table->dropColumn('native_name');
        });
    }
};
