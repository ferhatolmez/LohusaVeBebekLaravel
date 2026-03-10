<?php

use App\Models\LohusaForm;
use Illuminate\Support\Carbon;

it('redirects guests to login from dashboard', function () {
    $this->get(route('home'))->assertRedirect(route('login'));
});

it('shows login page', function () {
    $this->get(route('login'))->assertOk()->assertSee('Oturum Aç', false);
});

it('allows a valid user to login', function () {
    $this->seed(Database\Seeders\RolePermissionSeeder::class);

    $response = $this->post(route('login.store'), [
        'email' => 'admin@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertAuthenticated();
});

it('shows dashboard metrics to authenticated users', function () {
    signInAs('student');
    LohusaForm::factory()->create([
        'ad_soyad' => 'Ayse Yilmaz',
        'dogum_yeri' => 'Istanbul',
        'bebek_beslenmesi' => 'Anne susu',
        'created_at' => Carbon::parse('2026-03-01'),
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Klinik odaklı takip paneli', false)
        ->assertSee('Ayse Yilmaz');
});