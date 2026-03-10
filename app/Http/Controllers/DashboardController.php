<?php

namespace App\Http\Controllers;

use App\Models\BebekForm;
use App\Models\LohusaForm;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $last30Days = Carbon::now()->subDays(30);
        $lohusaForms = LohusaForm::latest()->get();
        $bebekForms = BebekForm::latest()->get();

        $stats = [
            'total_lohusa' => $lohusaForms->count(),
            'total_bebek' => $bebekForms->count(),
            'last_30_days' => LohusaForm::where('created_at', '>=', $last30Days)->count() + BebekForm::where('created_at', '>=', $last30Days)->count(),
            'avg_lohusa_completion' => (int) round($lohusaForms->avg('completion_score') ?? 0),
            'avg_bebek_completion' => (int) round($bebekForms->avg('completion_score') ?? 0),
        ];

        return view('welcome', [
            'stats' => $stats,
            'sonLohusaKayitlar' => $lohusaForms->take(4),
            'sonBebekKayitlar' => $bebekForms->take(4),
        ]);
    }
}
