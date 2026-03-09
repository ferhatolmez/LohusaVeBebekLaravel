<?php

use App\Models\BebekForm;

test('bebek form listesi sayfası yüklenir', function () {
    $response = $this->get(route('bebek.index'));

    $response->assertStatus(200);
    $response->assertSee('Bebek İzlem Formları');
});

test('bebek form oluşturma sayfası yüklenir', function () {
    $response = $this->get(route('bebek.create'));

    $response->assertStatus(200);
    $response->assertSee('Bebek İzlem Formu');
});

test('bebek formu geçerli veri ile kaydedilir', function () {
    $response = $this->post(route('bebek.store'), [
        'dogum_tarihi' => '2025-01-15',
        'cinsiyet' => 'Erkek',
        'termin_durumu' => 'Term',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('bebek_forms', [
        'dogum_tarihi' => '2025-01-15',
        'cinsiyet' => 'Erkek',
    ]);
});

test('bebek formu tüm alanlar boş bile olsa kaydedilir', function () {
    $response = $this->post(route('bebek.store'), [
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.index'));
    $response->assertSessionHas('success');
    $this->assertDatabaseCount('bebek_forms', 1);
});

test('bebek form detay sayfası gösterilir', function () {
    $form = BebekForm::factory()->create(['cinsiyet' => 'Kız']);

    $response = $this->get(route('bebek.show', $form));

    $response->assertStatus(200);
    $response->assertSee('Kız');
});

test('bebek form pdf olarak indirilebilir', function () {
    $form = BebekForm::factory()->create();

    $response = $this->get(route('bebek.pdf', $form->id));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/pdf');
});

test('bebek form düzenleme sayfası yüklenir', function () {
    $form = BebekForm::factory()->create();

    $response = $this->get(route('bebek.edit', $form));

    $response->assertStatus(200);
    $response->assertSee('Düzenle');
});

test('bebek formu güncellenebilir', function () {
    $form = BebekForm::factory()->create(['cinsiyet' => 'Erkek']);

    $response = $this->put(route('bebek.update', $form), [
        'cinsiyet' => 'Kız',
        'termin_durumu' => 'Term',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.index'));
    $response->assertSessionHas('success');
    expect($form->fresh()->cinsiyet)->toBe('Kız');
});

test('bebek formu silinebilir', function () {
    $form = BebekForm::factory()->create();

    $response = $this->delete(route('bebek.destroy', $form), [
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.index'));
    $response->assertSessionHas('success');
    $this->assertDatabaseMissing('bebek_forms', ['id' => $form->id]);
});
