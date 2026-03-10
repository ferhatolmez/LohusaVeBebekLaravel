<?php

namespace App\Listeners;

use App\Events\FormCreated;
use Illuminate\Support\Facades\Log;

class LogFormCreation
{
    public function handle(FormCreated $event): void
    {
        Log::channel('daily')->info('New form created', [
            'type' => $event->formType,
            'id' => $event->form->getKey(),
            'user' => auth()->user()?->name ?? 'system',
            'ip' => request()->ip(),
        ]);
    }
}
