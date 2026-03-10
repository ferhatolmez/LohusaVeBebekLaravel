<?php

use App\Models\LohusaForm;

test('ana sayfa basariyla yuklenir', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Validation');
    $response->assertSee('Lohusa');
    $response->assertSee('Bebek');
});

test('lohusa form listesi sayfasi yuklenir', function () {
    $response = $this->get(route('lohusa.index'));

    $response->assertOk();
    $response->assertSee('Lohusa kayitlari');
});

test('lohusa form olusturma sayfasi yuklenir', function () {
    $response = $this->get(route('lohusa.create'));

    $response->assertOk();
    $response->assertSee('Lohusa Izlem Formu');
});

test('lohusa formu gecerli veri ile kaydedilir', function () {
    $response = $this->post(route('lohusa.store'), [
        'ad_soyad' => 'Ayse Yilmaz',
        'yas' => 28,
        'egitim_durumu' => 'Universite',
        'meslek' => 'Ebe',
        'saglik_guvence' => 'SGK',
        'gebelik_planlandimi' => 'Evet',
        'dogum_yeri' => 'Istanbul',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('lohusa.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('lohusa_forms', [
        'ad_soyad' => 'Ayse Yilmaz',
        'yas' => 28,
    ]);
});

test('lohusa formu zorunlu alanlar olmadan kaydedilmez', function () {
    $response = $this->from(route('lohusa.create'))->post(route('lohusa.store'), [
        'ad_soyad' => '',
        'yas' => '',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('lohusa.create'));
    $response->assertSessionHasErrors(['ad_soyad', 'yas', 'egitim_durumu', 'meslek', 'saglik_guvence', 'gebelik_planlandimi', 'dogum_yeri']);
    $this->assertDatabaseCount('lohusa_forms', 0);
});

test('lohusa formu hatali veri tipleriyle kaydedilmez', function () {
    $response = $this->from(route('lohusa.create'))->post(route('lohusa.store'), [
        'ad_soyad' => 'Ayse123',
        'yas' => 'abc',
        'egitim_durumu' => 'Universite',
        'meslek' => '1234',
        'saglik_guvence' => 'SGK',
        'gebelik_planlandimi' => 'Evet',
        'dogum_yeri' => '123',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('lohusa.create'));
    $response->assertSessionHasErrors(['ad_soyad', 'yas', 'meslek', 'dogum_yeri']);
    $this->assertDatabaseCount('lohusa_forms', 0);
});

test('lohusa form detay sayfasi gosterilir', function () {
    $form = LohusaForm::factory()->create(['ad_soyad' => 'Test Kullanici']);

    $response = $this->get(route('lohusa.show', $form));

    $response->assertOk();
    $response->assertSee('Test Kullanici');
});

test('lohusa form pdf olarak indirilebilir', function () {
    $form = LohusaForm::factory()->create(['ad_soyad' => 'PDF Test']);

    $response = $this->get(route('lohusa.pdf', $form->id));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
    $response->assertHeader('content-disposition', 'attachment; filename="lohusa-izlem-formu.pdf"');
});

test('lohusa form silinebilir', function () {
    $form = LohusaForm::factory()->create(['ad_soyad' => 'Silinecek Kayit']);

    $response = $this->delete(route('lohusa.destroy', $form->id), [
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('lohusa.index'));
    $response->assertSessionHas('success');
    $this->assertDatabaseMissing('lohusa_forms', ['id' => $form->id]);
});
