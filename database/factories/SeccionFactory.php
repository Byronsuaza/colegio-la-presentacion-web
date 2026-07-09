<?php

namespace Database\Factories;

use App\Models\Seccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeccionFactory extends Factory
{
    protected $model = Seccion::class;

    public function definition()
    {
        $nombre = $this->faker->unique()->randomElement(['preescolar','primaria','bachillerato']);
        return [
            'nombre' => $nombre,
            'titulo' => ucfirst($nombre) . ' - Sección',
            'descripcion_corta' => $this->faker->sentence,
            'descripcion_completa' => $this->faker->optional()->paragraphs(3, true),
            'imagen_hero' => $this->faker->optional()->imageUrl(1200, 600, 'education'),
            'estadisticas' => [],
            'objetivos' => [],
            'caracteristicas' => [],
            'programas' => [],
            'grados' => [],
            'galeria' => [],
            'coordinador_nombre' => $this->faker->name,
            'coordinador_correo' => $this->faker->unique()->safeEmail,
            'coordinador_telefono' => $this->faker->phoneNumber,
        ];
    }
}
