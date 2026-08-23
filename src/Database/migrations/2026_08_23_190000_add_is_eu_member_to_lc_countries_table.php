<?php

use Aaix\LaravelCountries\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('lc_countries', function (Blueprint $table) {
            if (!Schema::hasColumn('lc_countries', 'is_eu_member')) {
                $table->boolean('is_eu_member')
                    ->default(false)
                    ->after('is_visible')
                    ->comment('Whether the country is a current member state of the European Union.');
            }
        });

        DB::table('lc_countries')
            ->whereIn(DB::raw('UPPER(iso_alpha_2)'), Country::EU_ISO_ALPHA_2)
            ->update(['is_eu_member' => true]);
    }

    public function down(): void
    {
        Schema::table('lc_countries', function (Blueprint $table) {
            if (Schema::hasColumn('lc_countries', 'is_eu_member')) {
                $table->dropColumn('is_eu_member');
            }
        });
    }
};
