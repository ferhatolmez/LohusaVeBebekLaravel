<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\BebekForm;

class BebekFormObserver
{
    public function created(BebekForm $form): void
    {
        ActivityLog::record('created', $form);
    }

    public function updated(BebekForm $form): void
    {
        ActivityLog::record('updated', $form, $form->getChanges());
    }

    public function deleted(BebekForm $form): void
    {
        ActivityLog::record('deleted', $form);
    }

    public function restored(BebekForm $form): void
    {
        ActivityLog::record('restored', $form);
    }
}
