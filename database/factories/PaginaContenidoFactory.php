<?php

namespace Database\Factories;

use App\Models\PaginaContenido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaginaContenidoFactory extends Factory
{
    protected $model = PaginaContenido::class;

    public function definition()
    {
        $base = $this->faker->randomElement(['nueva-seccion', 'admisiones', 'galeria', 'comunicaciones']);
        $slug = $this->faker->slug;
        return [
            'seccion' => $this->faker->word,
            'base' => $base,
            'slug' => $slug,
            'titulo' => $this->faker->sentence,
            'subtitulo' => $this->faker->optional()->sentence,
            'imagen' => $this->faker->optional()->imageUrl(800, 400, 'nature'),
            'url_externa' => $this->faker->optional()->url,
            'contenido' => $this->faker->optional()->paragraphs(3, true),
            'enlaces' => $this->faker->optional()->randomElements([
                ['titulo' => 'Docs', 'url' => $this->faker->url],
                ['titulo' => 'PDF', 'url' => $this->faker->url, 'archivo' => 'doc.pdf'],
            ]),
            'publicada' => true,
        ];
    }
}
