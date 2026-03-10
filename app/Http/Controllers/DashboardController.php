<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly DashboardService $dashboardService) {}

    public function __invoke(): View
    {
        $this->authorize('viewDashboard');

        return view('welcome', $this->dashboardService->summary());
    }
}
