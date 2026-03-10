<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\LohusaForm;

class LohusaFormObserver
{
    public function created(LohusaForm $form): void
    {
        ActivityLog::record('created', $form);
    }

    public function updated(LohusaForm $form): void
    {
        ActivityLog::record('updated', $form, $form->getChanges());
    }

    public function deleted(LohusaForm $form): void
    {
        ActivityLog::record('deleted', $form);
    }

    public function restored(LohusaForm $form): void
    {
        ActivityLog::record('restored', $form);
    }
}
