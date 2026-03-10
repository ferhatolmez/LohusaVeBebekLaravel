<?php

namespace App\Console\Commands;

use App\Models\BebekForm;
use App\Models\LohusaForm;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DailyReportCommand extends Command
{
    protected $signature = 'report:daily {--date= : Rapor tarihi (varsayılan: bugün)}';

    protected $description = 'Günlük klinik özet raporu oluşturur';

    public function handle(): int
    {
        $date = $this->option('date')
            ? Carbon::parse($this->option('date'))
            : Carbon::today();

        $this->info('');
        $this->info("  📊 Günlük Klinik Rapor — {$date->format('d.m.Y')}");
        $this->info(str_repeat('─', 50));

        // Toplam kayıtlar
        $totalLohusa = LohusaForm::query()->count();
        $totalBebek = BebekForm::query()->count();
        $todayLohusa = LohusaForm::query()->whereDate('created_at', $date)->count();
        $todayBebek = BebekForm::query()->whereDate('created_at', $date)->count();

        $this->table(
            ['Metrik', 'Değer'],
            [
                ['Toplam Lohusa', $totalLohusa],
                ['Toplam Bebek', $totalBebek],
                ['Bugünkü kayıt (Lohusa)', $todayLohusa],
                ['Bugünkü kayıt (Bebek)', $todayBebek],
            ]
        );

        // Geciken takipler
        $overdueLohusa = LohusaForm::all()
            ->filter(fn (LohusaForm $f) => $f->suggested_follow_up_date?->lt($date))
            ->count();

        $overdueBebek = BebekForm::all()
            ->filter(fn (BebekForm $f) => $f->suggested_follow_up_date?->lt($date))
            ->count();

        if ($overdueLohusa + $overdueBebek > 0) {
            $this->warn("  ⚠️  Geciken takipler: {$overdueLohusa} lohusa, {$overdueBebek} bebek");
        } else {
            $this->info('  ✅ Geciken takip bulunmuyor.');
        }

        // Kalite ortalaması
        $avgLohusa = (int) round(LohusaForm::query()->avg('completion_score') ?? 0);
        $avgBebek = (int) round(BebekForm::query()->avg('completion_score') ?? 0);

        $this->info('');
        $this->info("  📈 Ortalama tamamlılık: Lohusa %{$avgLohusa} | Bebek %{$avgBebek}");
        $this->info('');

        return self::SUCCESS;
    }
}
