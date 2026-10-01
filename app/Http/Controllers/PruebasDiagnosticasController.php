<?php

namespace App\Http\Controllers;

use App\Models\AjusteGeneral;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PruebasDiagnosticasController extends Controller
{
    /**
     * Verifica la contraseña de acceso a las pruebas diagnósticas.
     * La contraseña nunca se expone al frontend; solo se compara server-side.
     */
    public function verificar(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'max:255'],
        ]);

        $ajustes = AjusteGeneral::instancia();
        $stored  = $ajustes->pruebas_diagnosticas_password ?? '';

        // Si no hay contraseña configurada, acceso libre.
        if (empty($stored)) {
            return response()->json(['ok' => true]);
        }

        $ok = hash_equals($stored, (string) $request->password);

        return response()->json(['ok' => $ok], $ok ? 200 : 401);
    }
}
