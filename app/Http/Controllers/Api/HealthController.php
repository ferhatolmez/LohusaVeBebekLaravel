<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $dbOk = false;

        try {
            DB::connection()->getPdo();
            $dbOk = true;
        } catch (\Throwable) {
            // Database connection failed
        }

        $status = $dbOk ? 'ok' : 'degraded';
        $httpCode = $dbOk ? 200 : 503;

        return response()->json([
            'status' => $status,
            'database' => $dbOk,
            'timestamp' => now()->toIso8601String(),
            'laravel' => app()->version(),
            'php' => PHP_VERSION,
        ], $httpCode);
    }
}
