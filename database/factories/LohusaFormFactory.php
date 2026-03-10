<?php

namespace Database\Factories;

use App\Models\LohusaForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class LohusaFormFactory extends Factory
{
    protected $model = LohusaForm::class;

    public function definition(): array
    {
        return [
            'ad_soyad' => fake()->name(),
            'yas' => fake()->numberBetween(20, 45),
            'egitim_durumu' => 'Üniversite',
            'meslek' => 'Ebe',
            'saglik_guvence' => 'SGK',
            'gebelik_planlandimi' => 'Evet',
            'dogum_yeri' => fake()->city(),
            'muayene_tarihi' => now()->subDays(2)->toDateString(),
            'postpartum_gun' => 3,
            'bebek_beslenmesi' => 'Anne susu',
        ];
    }
}

