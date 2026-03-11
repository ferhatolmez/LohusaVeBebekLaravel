<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Convert any existing non-JSON text values to valid JSON before changing the column type
        DB::table('lohusa_forms')
            ->whereNotNull('alinan_besin_gruplari')
            ->where('alinan_besin_gruplari', 'NOT LIKE', '[%')
            ->where('alinan_besin_gruplari', '!=', '')
            ->update(['alinan_besin_gruplari' => DB::raw("'[]'")]);

        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->json('alinan_besin_gruplari')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->text('alinan_besin_gruplari')->nullable()->change();
        });
    }
};
