<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BebekFormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LohusaFormController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('home');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/lohusa/csrf-refresh', fn () => response()->json(['token' => csrf_token()]))->name('lohusa.csrf-refresh');

    Route::prefix('lohusa')->name('lohusa.')->group(function () {
        Route::get('/', [LohusaFormController::class, 'index'])->name('index');
        Route::get('/create', [LohusaFormController::class, 'create'])->middleware('permission:create lohusa forms')->name('create');
        Route::post('/', [LohusaFormController::class, 'store'])->middleware('permission:create lohusa forms')->name('store');
        Route::get('/{lohusaForm}', [LohusaFormController::class, 'show'])->name('show');
        Route::delete('/{lohusaForm}', [LohusaFormController::class, 'destroy'])->middleware('permission:delete lohusa forms')->name('destroy');
        Route::get('/{lohusaForm}/pdf', [LohusaFormController::class, 'exportPdf'])->middleware('permission:export lohusa forms')->name('pdf');
    });

    Route::prefix('bebek')->name('bebek.')->group(function () {
        Route::get('/', [BebekFormController::class, 'index'])->name('index');
        Route::get('/create', [BebekFormController::class, 'create'])->middleware('permission:create bebek forms')->name('create');
        Route::post('/', [BebekFormController::class, 'store'])->middleware('permission:create bebek forms')->name('store');
        Route::get('/{bebekForm}/pdf', [BebekFormController::class, 'exportPdf'])->middleware('permission:export bebek forms')->name('pdf');
        Route::get('/{bebekForm}/edit', [BebekFormController::class, 'edit'])->middleware('permission:update bebek forms')->name('edit');
        Route::put('/{bebekForm}', [BebekFormController::class, 'update'])->middleware('permission:update bebek forms')->name('update');
        Route::delete('/{bebekForm}', [BebekFormController::class, 'destroy'])->middleware('permission:delete bebek forms')->name('destroy');
        Route::get('/{bebekForm}', [BebekFormController::class, 'show'])->name('show');
    });
});
