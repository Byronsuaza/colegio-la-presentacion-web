<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePostulacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_completo' => 'required|string|max:255',
            'telefono' => ['required', 'string', 'max:50', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'email' => 'required|email|max:255',
            'cargo' => 'required|string|max:255',
            'hoja_vida' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'habeas_data' => 'required|accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'telefono.required' => 'El número de contacto es obligatorio.',
            'telefono.regex' => 'Ingrese un número de contacto válido.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'cargo.required' => 'Seleccione el cargo o vacante a la que aplica.',
            'hoja_vida.required' => 'Debe adjuntar su hoja de vida.',
            'hoja_vida.mimes' => 'La hoja de vida debe estar en formato PDF o Word (doc, docx).',
            'hoja_vida.max' => 'La hoja de vida no puede pesar más de 5MB.',
            'hoja_vida.uploaded' => 'No se pudo cargar el archivo. Verifique que no supere los 5MB.',
            'habeas_data.required' => 'Debe autorizar el tratamiento de sus datos personales.',
            'habeas_data.accepted' => 'Debe autorizar el tratamiento de sus datos personales.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
