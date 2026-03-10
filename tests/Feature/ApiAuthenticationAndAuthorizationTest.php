<?php

use App\Models\LohusaForm;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

it('issues sanctum token for authorized user', function () {
    $response = $this->postJson(route('api.v1.auth.token'), [
        'email' => 'ebe@example.com',
        'password' => 'password',
        'device_name' => 'pest-suite',
    ]);

    $response->assertCreated()->assertJsonStructure(['token', 'token_type', 'user' => ['email', 'roles']]);
});

it('requires sanctum token for lohusa api', function () {
    $this->getJson('/api/v1/lohusa')->assertUnauthorized();
});

it('allows student to read but not create via api', function () {
    $user = User::query()->where('email', 'student@example.com')->firstOrFail();
    LohusaForm::factory()->create(['ad_soyad' => 'API Kayit']);
    Sanctum::actingAs($user);

    $this->getJson('/api/v1/lohusa')->assertOk()->assertJsonFragment(['ad_soyad' => 'API Kayit']);

    $this->postJson('/api/v1/lohusa', [
        'ad_soyad' => 'Yeni API Kayit',
        'yas' => 28,
        'egitim_durumu' => 'Üniversite',
        'meslek' => 'Ebe',
        'saglik_guvence' => 'SGK',
        'gebelik_planlandimi' => 'Evet',
        'dogum_yeri' => 'Istanbul',
    ])->assertForbidden();
});

it('allows ebe to create and update bebek via api', function () {
    $user = User::query()->where('email', 'ebe@example.com')->firstOrFail();
    Sanctum::actingAs($user);

    $create = $this->postJson('/api/v1/bebek', [
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
    ]);

    $create->assertCreated();
    $id = $create->json('data.id');

    $this->putJson('/api/v1/bebek/'.$id, [
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
    ])->assertOk()->assertJsonPath('data.cinsiyet', 'Kız');

    $this->assertDatabaseHas('bebek_forms', ['id' => $id, 'cinsiyet' => 'Kız']);
});
