<?php

use App\Models\LohusaForm;
use Illuminate\Support\Carbon;

it('calculates follow up label for first week postpartum control', function () {
    $form = new LohusaForm([
        'dogum_tarihi' => Carbon::parse('2026-03-01'),
        'postpartum_gun' => 3,
    ]);

    expect($form->suggested_follow_up_label)->toBe('1. hafta kontrolu');
    expect($form->suggested_follow_up_date?->toDateString())->toBe('2026-03-05');
});
