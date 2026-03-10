<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->json('fiziksel_muayene')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->dropColumn('fiziksel_muayene');
        });
    }
};
