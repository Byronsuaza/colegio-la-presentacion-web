<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AjusteGeneral;
use App\Services\AdmissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdmissionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_ajustes_dynamic_year_replacement()
    {
        AjusteGeneral::factory()->create([
            'admisiones_anio' => 2026,
            'admisiones_descripcion' => 'Año lectivo 2025',
        ]);

        $ajuste = AdmissionService::ajustesConAdmisionesDinamicas();
        $this->assertStringContainsString('año lectivo 2026', $ajuste->admisiones_descripcion);
    }

    public function test_body_content_replacement()
    {
        AjusteGeneral::factory()->create(['admisiones_anio' => 2026]);
        $ajuste = AdmissionService::ajustesConAdmisionesDinamicas();
        $content = 'INSCRIPCIONES ABIERTAS PARA EL AÑO 2025. año lectivo 2025.';
        $result = AdmissionService::reemplazarAnioEnContenido($content, $ajuste);
        $this->assertStringContainsString('2026', $result);
    }
}
