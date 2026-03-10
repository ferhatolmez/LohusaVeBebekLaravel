<?php

namespace App\Services;

use App\Models\BebekForm;
use App\Models\LohusaForm;
use App\Repositories\BebekFormRepository;
use App\Repositories\LohusaFormRepository;
use Illuminate\Support\Carbon;

class DashboardService
{
    public function __construct(
        private readonly LohusaFormRepository $lohusaRepository,
        private readonly BebekFormRepository $bebekRepository,
    ) {}

    public function summary(): array
    {
        $today = Carbon::today();
        $last30Days = $today->copy()->subDays(30);
        $lohusaForms = $this->lohusaRepository->allLatest();
        $bebekForms = $this->bebekRepository->allLatest();

        $allLohusaFollowUps = $lohusaForms
            ->filter(fn (LohusaForm $form) => $form->suggested_follow_up_date)
            ->sortBy(fn (LohusaForm $form) => $form->suggested_follow_up_date)
            ->values();

        $allBebekFollowUps = $bebekForms
            ->filter(fn (BebekForm $form) => $form->suggested_follow_up_date)
            ->sortBy(fn (BebekForm $form) => $form->suggested_follow_up_date)
            ->values();

        return [
            'stats' => [
                'total_lohusa' => $lohusaForms->count(),
                'total_bebek' => $bebekForms->count(),
                'last_30_days' => LohusaForm::query()->where('created_at', '>=', $last30Days)->count() + BebekForm::query()->where('created_at', '>=', $last30Days)->count(),
                'avg_lohusa_completion' => (int) round($lohusaForms->avg('completion_score') ?? 0),
                'avg_bebek_completion' => (int) round($bebekForms->avg('completion_score') ?? 0),
                'upcoming_follow_ups' => $allLohusaFollowUps->count() + $allBebekFollowUps->count(),
                'overdue_follow_ups' => $allLohusaFollowUps->filter(fn (LohusaForm $form) => $form->suggested_follow_up_date->lt($today))->count() + $allBebekFollowUps->filter(fn (BebekForm $form) => $form->suggested_follow_up_date->lt($today))->count(),
            ],
            'sonLohusaKayitlar' => $lohusaForms->take(4),
            'sonBebekKayitlar' => $bebekForms->take(4),
            'upcomingLohusaFollowUps' => $allLohusaFollowUps->take(5),
            'upcomingBebekFollowUps' => $allBebekFollowUps->take(5),
            'termBreakdown' => $bebekForms->groupBy(fn (BebekForm $form) => $form->termin_durumu ?: 'Belirtilmedi')->map->count()->sortDesc(),
            'feedingBreakdown' => $lohusaForms->filter(fn (LohusaForm $form) => filled($form->bebek_beslenmesi))->groupBy('bebek_beslenmesi')->map->count()->sortDesc(),
            'monthlyTrend' => $this->monthlyTrend(),
        ];
    }

    private function monthlyTrend(): array
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::today()->subMonths($i);
            $label = $date->translatedFormat('M Y');
            $months->push([
                'label' => $label,
                'lohusa' => LohusaForm::query()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'bebek' => BebekForm::query()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ]);
        }

        return $months->toArray();
    }
}
