<?php

use App\Models\LohusaForm;

test('ana sayfa başarıyla yüklenir', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Lohusa');
    $response->assertSee('Bebek');
});

test('lohusa form listesi sayfası yüklenir', function () {
    $response = $this->get(route('lohusa.index'));

    $response->assertStatus(200);
    $response->assertSee('Lohusa ve Bebek İzlem Formları');
});

test('lohusa form oluşturma sayfası yüklenir', function () {
    $response = $this->get(route('lohusa.create'));

    $response->assertStatus(200);
    $response->assertSee('Lohusa İzlem Formu');
});

test('lohusa formu geçerli veri ile kaydedilir', function () {
    $response = $this->post(route('lohusa.store'), [
        'ad_soyad' => 'Ayşe Yılmaz',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('lohusa.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('lohusa_forms', [
        'ad_soyad' => 'Ayşe Yılmaz',
    ]);
});

test('lohusa formu ad soyad olmadan kaydedilmez', function () {
    $response = $this->post(route('lohusa.store'), [
        'ad_soyad' => '',
        '_token' => csrf_token(),
    ]);

    $response->assertSessionHasErrors('ad_soyad');
    $this->assertDatabaseCount('lohusa_forms', 0);
});

test('lohusa form detay sayfası gösterilir', function () {
    $form = LohusaForm::factory()->create(['ad_soyad' => 'Test Kullanıcı']);

    $response = $this->get(route('lohusa.show', $form));

    $response->assertStatus(200);
    $response->assertSee('Test Kullanıcı');
});

test('lohusa form pdf olarak indirilebilir', function () {
    $form = LohusaForm::factory()->create(['ad_soyad' => 'PDF Test']);

    $response = $this->get(route('lohusa.pdf', $form->id));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/pdf');
    $response->assertHeader('content-disposition', 'attachment; filename="lohusa-izlem-formu.pdf"');
});

test('lohusa form silinebilir', function () {
    $form = LohusaForm::factory()->create(['ad_soyad' => 'Silinecek Kayıt']);

    $response = $this->delete(route('lohusa.destroy', $form->id), [
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('lohusa.index'));
    $response->assertSessionHas('success');
    $this->assertDatabaseMissing('lohusa_forms', ['id' => $form->id]);
});
