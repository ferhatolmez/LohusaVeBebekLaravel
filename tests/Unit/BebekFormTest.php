<?php

use App\Models\BebekForm;

it('calculates completion score from required bebek fields', function () {
    $form = new BebekForm([
        'dogum_tarihi' => now()->subDay(),
        'kac_haftalik' => 40,
        'muayene_tarihi' => now(),
        'izlem_sayisi' => 1,
        'termin_durumu' => 'Term',
        'cinsiyet' => 'Erkek',
        'kacinci_cocuk' => 1,
        'kan_grubu' => 'A Rh+',
        'ates' => 36.5,
        'nabiz' => 120,
        'solunum' => 40,
        'kilo' => 3.2,
        'boy' => 50,
        'bas_cevresi' => 34,
        'gogus_cevresi' => 32,
        'deri' => ['Pembe, gergin, puruzsuz'],
        'solunum_sistemi' => ['Normal'],
        'kvs' => ['Normal'],
        'norolojik' => ['Normal'],
    ]);

    expect($form->completion_score)->toBe(100);
});
