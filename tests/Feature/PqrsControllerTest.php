<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PqrsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_errors_when_required_fields_missing()
    {
        $response = $this->postJson('/pqrs', []);
        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'errors']);
    }

    public function test_successful_submission_without_turnstile()
    {
        // Desactivar la verificación de Turnstile para el test
        config(['services.turnstile.secret_key' => null]);

        $payload = [
            'tipo' => 'Petición',
            'nombre_completo' => 'Juan Pérez',
            'tipo_documento' => 'CC',
            'documento' => '12345678',
            'email' => 'juan@example.com',
            'telefono' => '3001234567',
            'relacion' => 'Padre',
            'mensaje' => 'Consulta de prueba',
            'habeas_data' => '1',
        ];

        $response = $this->postJson('/pqrs', $payload);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('pqrs_submissions', ['email' => 'juan@example.com']);
    }
}
