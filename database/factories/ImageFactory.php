<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Usa `storage_path()` para obtener la ruta absoluta y confiable
            'url' => 'images/' . $this->faker->image(
                storage_path('app/public/images'),
                640,
                480,
                null,
                false
            ),
            
            // Laravel llenará estos campos automáticamente cuando uses `->has()`
            // por lo que los inicializamos con `null` o los dejamos fuera.
            'imageable_id' => null, 
            'imageable_type' => null,
        ];
    }
}