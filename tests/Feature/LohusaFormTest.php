<?php

use App\Models\LohusaForm;
use Illuminate\Support\Carbon;

it('lists lohusa records for authorized users', function () {
    signInAs('ebe');

    $response = $this->get(route('lohusa.index'));

    $response->assertOk()->assertSee('Lohusa Kayıtları', false);
});

it('filters lohusa records with clinical filters', function () {
    signInAs('ebe');

    LohusaForm::factory()->create([
        'ad_soyad' => 'Ayse Yilmaz',
        'dogum_yeri' => 'Istanbul',
        'bebek_beslenmesi' => 'Anne susu',
        'postpartum_hafta' => 2,
        'created_at' => Carbon::parse('2026-03-01'),
    ]);

    LohusaForm::factory()->create([
        'ad_soyad' => 'Fatma Demir',
        'dogum_yeri' => 'Ankara',
        'bebek_beslenmesi' => 'Mama',
        'postpartum_hafta' => 1,
        'created_at' => Carbon::parse('2026-02-01'),
    ]);

    $this->get(route('lohusa.index', [
        'dogum_yeri' => 'Istanbul',
        'bebek_beslenmesi' => 'Anne susu',
        'postpartum_hafta_min' => 2,
        'created_from' => '2026-02-15',
    ]))
        ->assertOk()
        ->assertSee('Ayse Yilmaz')
        ->assertDontSee('Fatma Demir');
});

it('stores a lohusa form for ebe role', function () {
    signInAs('ebe');

    $this->post(route('lohusa.store'), [
        'ad_soyad' => 'Ayse Yilmaz',
        'yas' => 28,
        'egitim_durumu' => 'Üniversite',
        'meslek' => 'Ebe',
        'saglik_guvence' => 'SGK',
        'gebelik_planlandimi' => 'Evet',
        'dogum_yeri' => 'Istanbul',
    ])
        ->assertRedirect(route('lohusa.index'))
        ->assertSessionHas('clear_lohusa_draft', true);

    $this->assertDatabaseHas('lohusa_forms', ['ad_soyad' => 'Ayse Yilmaz']);
});

it('forbids student from creating lohusa form', function () {
    signInAs('student');

    $this->get(route('lohusa.create'))->assertForbidden();
    $this->post(route('lohusa.store'), [
        'ad_soyad' => 'Ayse Yilmaz',
        'yas' => 28,
        'egitim_durumu' => 'Üniversite',
        'meslek' => 'Ebe',
        'saglik_guvence' => 'SGK',
        'gebelik_planlandimi' => 'Evet',
        'dogum_yeri' => 'Istanbul',
    ])->assertForbidden();
});

it('downloads lohusa pdf for authorized users', function () {
    signInAs('student');
    $form = LohusaForm::factory()->create(['ad_soyad' => 'PDF Test']);

    $this->get(route('lohusa.pdf', $form))
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf');
});

