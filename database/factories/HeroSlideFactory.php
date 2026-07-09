<?php

namespace Database\Factories;

use App\Models\HeroSlide;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HeroSlideFactory extends Factory
{
    protected $model = HeroSlide::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'subtitulo' => $this->faker->sentence,
            'imagen' => $this->faker->imageUrl(1200, 600, 'people'),
            'orden' => $this->faker->numberBetween(0, 10),
            'activo' => true,
        ];
    }
}
