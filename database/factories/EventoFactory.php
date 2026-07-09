<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    protected $model = Evento::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'fecha' => $this->faker->dateTimeBetween('now', '+30 days'),
            'hora' => $this->faker->time('H:i'),
            'lugar' => $this->faker->city,
            'es_activo' => true,
        ];
    }
}
