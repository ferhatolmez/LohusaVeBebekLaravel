<?php

namespace Database\Factories;

use App\Models\BebekForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class BebekFormFactory extends Factory
{
    protected $model = BebekForm::class;

    public function definition(): array
    {
        return [
            'dogum_tarihi' => now()->subDays(5)->toDateString(),
            'kac_haftalik' => 40,
            'muayene_tarihi' => now()->subDays(3)->toDateString(),
            'izlem_sayisi' => 1,
            'termin_durumu' => 'Term',
            'cinsiyet' => fake()->randomElement(['Erkek', 'Kız']),
            'kacinci_cocuk' => 1,
            'kan_grubu' => 'A Rh+',
            'ates' => 36.5,
            'nabiz' => 120,
            'solunum' => 40,
            'kilo' => 3.2,
            'boy' => 50,
            'bas_cevresi' => 34,
            'gogus_cevresi' => 32,
        ];
    }
}

