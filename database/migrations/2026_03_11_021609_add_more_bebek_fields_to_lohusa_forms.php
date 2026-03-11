<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->date('bebek_muayene_tarihi')->nullable()->after('muayene_tarihi');
            $table->string('bebek_kan_grubu')->nullable()->after('kan_grubu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->dropColumn(['bebek_muayene_tarihi', 'bebek_kan_grubu']);
        });
    }
};
