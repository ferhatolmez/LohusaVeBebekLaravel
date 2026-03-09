<?php

namespace Database\Factories;

use App\Models\LohusaForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LohusaForm>
 */
class LohusaFormFactory extends Factory
{
    protected $model = LohusaForm::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ad_soyad' => fake()->name(),
            'yas' => fake()->numberBetween(20, 45),
        ];
    }
}
