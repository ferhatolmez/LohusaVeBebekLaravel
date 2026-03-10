<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public readonly string $formType;

    public function __construct(
        public readonly Model $form,
        ?string $formType = null,
    ) {
        $this->formType = $formType ?? match (true) {
            $form instanceof \App\Models\BebekForm => 'bebek',
            $form instanceof \App\Models\LohusaForm => 'lohusa',
            default => 'unknown',
        };
    }
}
