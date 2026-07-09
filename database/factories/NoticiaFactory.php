<?php

namespace Database\Factories;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiaFactory extends Factory
{
    protected $model = Noticia::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'categoria' => $this->faker->randomElement(['General', 'Cultura', 'Deportes', 'Académico']),
            'imagen' => $this->faker->imageUrl(800, 400, 'business'),
            'contenido' => $this->faker->paragraphs(3, true),
            'destacada' => $this->faker->boolean,
        ];
    }
}
