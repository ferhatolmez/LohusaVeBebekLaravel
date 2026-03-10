<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->json('losia_bulgulari')->nullable()->after('losia_tipi');
            $table->text('yeme_aliskanligi_aciklama')->nullable()->after('yeme_aliskanligi');
            $table->text('yiyemedigi_yiyecek_aciklama')->nullable()->after('yiyemedigi_yiyecek');
            $table->text('psikolojik_diger_aciklama')->nullable()->after('psikolojik_belirtiler');
        });
    }

    public function down(): void
    {
        Schema::table('lohusa_forms', function (Blueprint $table) {
            $table->dropColumn([
                'losia_bulgulari',
                'yeme_aliskanligi_aciklama',
                'yiyemedigi_yiyecek_aciklama',
                'psikolojik_diger_aciklama',
            ]);
        });
    }
};
