<?php

namespace Database\Factories;

use App\Models\BebekForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BebekForm>
 */
class BebekFormFactory extends Factory
{
    protected $model = BebekForm::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dogum_tarihi' => fake()->date(),
            'cinsiyet' => fake()->randomElement(['Erkek', 'Kız']),
            'termin_durumu' => 'Term',
        ];
    }
}
