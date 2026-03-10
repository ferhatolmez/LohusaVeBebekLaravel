<?php

use App\Models\BebekForm;

test('bebek form listesi sayfasi yuklenir', function () {
    $response = $this->get(route('bebek.index'));

    $response->assertOk();
    $response->assertSee('Bebek kayitlari');
});

test('bebek form olusturma sayfasi yuklenir', function () {
    $response = $this->get(route('bebek.create'));

    $response->assertOk();
    $response->assertSee('Bebek Izlem Formu');
});

test('bebek formu gecerli veri ile kaydedilir', function () {
    $response = $this->post(route('bebek.store'), [
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
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('bebek_forms', [
        'dogum_tarihi' => '2025-01-15',
        'cinsiyet' => 'Erkek',
    ]);
});

test('bebek formu bos gonderilirse reddedilir', function () {
    $response = $this->from(route('bebek.create'))->post(route('bebek.store'), [
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.create'));
    $response->assertSessionHasErrors([
        'dogum_tarihi', 'kac_haftalik', 'muayene_tarihi', 'izlem_sayisi', 'termin_durumu',
        'cinsiyet', 'kacinci_cocuk', 'kan_grubu', 'ates', 'nabiz', 'solunum', 'kilo', 'boy', 'bas_cevresi', 'gogus_cevresi',
    ]);
    $this->assertDatabaseCount('bebek_forms', 0);
});

test('bebek formu tip hatalariyla kaydedilmez', function () {
    $response = $this->from(route('bebek.create'))->post(route('bebek.store'), [
        'dogum_tarihi' => '2025-01-15',
        'kac_haftalik' => 'abc',
        'muayene_tarihi' => '2025-01-10',
        'izlem_sayisi' => 'ilk',
        'termin_durumu' => 'Yanlis',
        'cinsiyet' => 'Belirsiz',
        'kacinci_cocuk' => 'bir',
        'kan_grubu' => 'XX',
        'ates' => 'ates',
        'nabiz' => 'hizli',
        'solunum' => 'cok',
        'kilo' => 'agir',
        'boy' => 'uzun',
        'bas_cevresi' => 'buyuk',
        'gogus_cevresi' => 'normal',
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.create'));
    $response->assertSessionHasErrors([
        'kac_haftalik', 'muayene_tarihi', 'izlem_sayisi', 'termin_durumu', 'cinsiyet',
        'kacinci_cocuk', 'kan_grubu', 'ates', 'nabiz', 'solunum', 'kilo', 'boy', 'bas_cevresi', 'gogus_cevresi',
    ]);
    $this->assertDatabaseCount('bebek_forms', 0);
});

test('bebek form detay sayfasi gosterilir', function () {
    $form = BebekForm::factory()->create(['cinsiyet' => 'Kiz']);

    $response = $this->get(route('bebek.show', $form));

    $response->assertOk();
    $response->assertSee('Kiz');
});

test('bebek form pdf olarak indirilebilir', function () {
    $form = BebekForm::factory()->create();

    $response = $this->get(route('bebek.pdf', $form->id));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
    $response->assertHeader('content-disposition', 'attachment; filename="bebek-izlem-formu.pdf"');
});

test('bebek form duzenleme sayfasi yuklenir', function () {
    $form = BebekForm::factory()->create();

    $response = $this->get(route('bebek.edit', $form));

    $response->assertOk();
    $response->assertSee('Bebek kaydini duzenle');
});

test('bebek formu guncellenebilir', function () {
    $form = BebekForm::factory()->create(['cinsiyet' => 'Erkek']);

    $response = $this->put(route('bebek.update', $form), [
        'dogum_tarihi' => '2025-01-15',
        'kac_haftalik' => 39,
        'muayene_tarihi' => '2025-01-18',
        'izlem_sayisi' => 2,
        'termin_durumu' => 'Term',
        'cinsiyet' => 'Kiz',
        'kacinci_cocuk' => 1,
        'kan_grubu' => 'B Rh+',
        'ates' => 36.7,
        'nabiz' => 118,
        'solunum' => 38,
        'kilo' => 3.4,
        'boy' => 51,
        'bas_cevresi' => 35,
        'gogus_cevresi' => 33,
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect(route('bebek.index'));
    $response->assertSessionHas('success');
    expect($form->fresh()->cinsiyet)->toBe('Kiz');
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
