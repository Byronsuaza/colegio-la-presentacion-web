<?php

namespace Database\Factories;

use App\Models\PqrsSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PqrsSubmissionFactory extends Factory
{
    protected $model = PqrsSubmission::class;

    public function definition()
    {
        return [
            'tipo' => $this->faker->randomElement(['Petición','Queja','Reclamo','Sugerencia','Felicitación']),
            'nombre_completo' => $this->faker->name,
            'tipo_documento' => $this->faker->randomElement(['CC','TI','CE','RC']),
            'documento' => $this->faker->numerify('########'),
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'relacion' => $this->faker->randomElement(['Padre','Estudiante','Otro']),
            'estudiante_nombre' => $this->faker->optional()->name,
            'estudiante_grado' => $this->faker->optional()->randomElement(['5','6','7','8','9']),
            'mensaje' => $this->faker->paragraph,
            'adjunto' => null,
            'estado' => 'Pendiente',
            'respuesta' => null,
            'respondido_at' => null,
        ];
    }
}
