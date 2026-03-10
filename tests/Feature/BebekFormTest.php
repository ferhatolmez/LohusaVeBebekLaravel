<?php

use App\Models\BebekForm;

it('lists bebek records for authorized users', function () {
    signInAs('student');

    $this->get(route('bebek.index'))->assertOk()->assertSee('Bebek kayitlari');
});

it('stores and updates bebek forms for ebe role', function () {
    signInAs('ebe');

    $this->post(route('bebek.store'), [
        'dogum_tarihi' => '2025-01-15',
        'kac_haftalik' => 40,
        'muayene_tarihi' => '2025-01-20',
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
    ])->assertRedirect(route('bebek.index'));

    $form = BebekForm::firstOrFail();

    $this->put(route('bebek.update', $form), [
        'dogum_tarihi' => '2025-01-15',
        'kac_haftalik' => 39,
        'muayene_tarihi' => '2025-01-18',
        'izlem_sayisi' => 2,
        'termin_durumu' => 'Term',
        'cinsiyet' => 'Kız',
        'kacinci_cocuk' => 1,
        'kan_grubu' => 'B Rh+',
        'ates' => 36.7,
        'nabiz' => 118,
        'solunum' => 38,
        'kilo' => 3.4,
        'boy' => 51,
        'bas_cevresi' => 35,
        'gogus_cevresi' => 33,
    ])->assertRedirect(route('bebek.index'));

    expect($form->fresh()->cinsiyet)->toBe('Kız');
});

it('forbids student from updating bebek form', function () {
    signInAs('student');
    $form = BebekForm::factory()->create();

    $this->get(route('bebek.edit', $form))->assertForbidden();
    $this->put(route('bebek.update', $form), [
        'dogum_tarihi' => '2025-01-15',
        'kac_haftalik' => 39,
        'muayene_tarihi' => '2025-01-18',
        'izlem_sayisi' => 2,
        'termin_durumu' => 'Term',
        'cinsiyet' => 'Kız',
        'kacinci_cocuk' => 1,
        'kan_grubu' => 'B Rh+',
        'ates' => 36.7,
        'nabiz' => 118,
        'solunum' => 38,
        'kilo' => 3.4,
        'boy' => 51,
        'bas_cevresi' => 35,
        'gogus_cevresi' => 33,
    ])->assertForbidden();
});
