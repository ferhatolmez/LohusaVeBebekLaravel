<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\LohusaForm;

class LohusaFormObserver
{
    public function created(LohusaForm $form): void
    {
        ActivityLog::record('created', $form);
        \Illuminate\Support\Facades\Cache::forget('lohusa_filter_options');
    }

    public function updated(LohusaForm $form): void
    {
        ActivityLog::record('updated', $form, $form->getChanges());
        \Illuminate\Support\Facades\Cache::forget('lohusa_filter_options');
    }

    public function deleted(LohusaForm $form): void
    {
        ActivityLog::record('deleted', $form);
        \Illuminate\Support\Facades\Cache::forget('lohusa_filter_options');
    }

    public function restored(LohusaForm $form): void
    {
        ActivityLog::record('restored', $form);
        \Illuminate\Support\Facades\Cache::forget('lohusa_filter_options');
    }
}
