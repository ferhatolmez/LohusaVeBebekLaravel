<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, convert any non-JSON or empty text values to valid JSON '[]'
        DB::table('lohusa_forms')
            ->whereNotNull('alinan_besin_gruplari')
            ->where('alinan_besin_gruplari', 'NOT LIKE', '[%')
            ->where('alinan_besin_gruplari', '!=', '')
            ->update(['alinan_besin_gruplari' => '[]']);

        DB::table('lohusa_forms')
            ->where('alinan_besin_gruplari', '')
            ->update(['alinan_besin_gruplari' => null]);

        // Use raw SQL with USING clause for PostgreSQL text->json cast
        DB::statement('ALTER TABLE lohusa_forms ALTER COLUMN alinan_besin_gruplari TYPE json USING alinan_besin_gruplari::json');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE lohusa_forms ALTER COLUMN alinan_besin_gruplari TYPE text USING alinan_besin_gruplari::text');
    }
};
