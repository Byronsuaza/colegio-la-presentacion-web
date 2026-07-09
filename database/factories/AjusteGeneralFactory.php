<?php

namespace Database\Factories;

use App\Models\AjusteGeneral;
use Illuminate\Database\Eloquent\Factories\Factory;

class AjusteGeneralFactory extends Factory
{
    protected $model = AjusteGeneral::class;

    public function definition()
    {
        return [
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'facebook' => $this->faker->url,
            'instagram' => $this->faker->url,
            'whatsapp' => $this->faker->phoneNumber,
            'admisiones_anio' => $this->faker->year,
            'admisiones_titulo' => $this->faker->sentence,
            'admisiones_descripcion' => $this->faker->paragraph,
            'admisiones_boton_texto' => $this->faker->word,
            'admisiones_boton_url' => $this->faker->url,
            'admisiones_llamada_texto' => $this->faker->sentence,
            'evangelio_embed_url' => $this->faker->url,
            'pago_en_linea_url' => $this->faker->url,
            'syscolegios_url' => $this->faker->url,
        ];
    }
}
