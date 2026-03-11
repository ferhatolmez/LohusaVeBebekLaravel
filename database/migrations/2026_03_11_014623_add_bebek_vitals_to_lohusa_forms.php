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
            $table->float('bebek_ates')->nullable()->after('ates');
            $table->float('bebek_nabiz')->nullable()->after('nabiz');
            $table->float('bebek_solunum')->nullable()->after('solunum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->dropColumn(['bebek_ates', 'bebek_nabiz', 'bebek_solunum']);
        });
    }
};
