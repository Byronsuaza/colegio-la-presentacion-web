<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StorePqrsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'tipo' => 'required|string|in:Petición,Queja,Reclamo,Sugerencia,Felicitación',
            'nombre_completo' => 'required|string|max:255',
            'tipo_documento' => 'required|string|max:50',
            'documento' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:50',
            'relacion' => 'required|string|max:100',
            'estudiante_nombre' => 'nullable|string|max:255',
            'estudiante_grado' => 'nullable|string|max:50',
            'mensaje' => 'required|string|max:5000',
            'adjunto' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'habeas_data' => 'required|accepted',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'tipo.required' => 'El tipo de solicitud es obligatorio.',
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'documento.required' => 'El número de documento es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'relacion.required' => 'La relación con la institución es obligatoria.',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'habeas_data.required' => 'Debe aceptar la política de tratamiento de datos.',
            'habeas_data.accepted' => 'Debe aceptar la política de tratamiento de datos.',
            'adjunto.mimes' => 'El archivo adjunto debe ser de tipo: pdf, doc, docx, jpg, jpeg o png.',
            'adjunto.max' => 'El archivo adjunto no puede pesar más de 5MB.',
        ];
    }

    /**
     * Convert validation errors into a JSON response with a consistent structure.
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);

        throw (new ValidationException($validator, $response));
    }
}
