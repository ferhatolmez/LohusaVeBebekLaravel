<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bebek_forms', function (Blueprint $table) {
            $table->string('termin_durumu')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('bebek_forms', function (Blueprint $table) {
            $table->enum('termin_durumu', ['Term', 'Prematur', 'Postmatur'])->nullable()->change();
        });
    }
};
