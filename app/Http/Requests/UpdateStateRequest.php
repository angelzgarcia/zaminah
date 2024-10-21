<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStateRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:50',
                'regex: /^[\pL\s]+$/u',
                Rule::unique('estados', 'nombre') -> ignore($this -> route('state') -> idEstadoRepublica, 'idEstadoRepublica'),
            ],
            'capital' => [
                'required',
                'string',
                'max:60',
                'regex: /^[\pL\s]+$/u',
                Rule::unique('estados', 'capital') -> ignore($this -> route('state') -> idEstadoRepublica, 'idEstadoRepublica'),
            ],
            'video' => [
                'required',
                'string',
                Rule::unique('estados', 'video') -> ignore($this -> route('state') -> idEstadoRepublica, 'idEstadoRepublica'),
            ],
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'triptico' => 'nullable|file|mimes:pdf',
            'guia' => 'nullable|file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'foto.required' => 'La imagen es obligatoria.',
            'foto.mimes' => 'Solo se permiten imagenes.',
            'triptico.required' => 'El archivo PDF es obligatorio.',
            'triptico.mimes' => 'Solo se permiten archivos en formato PDF.',
            'guia.required' => 'El archivo PDF es obligatorio.',
            'guia.mimes' => 'Solo se permiten archivos en formato PDF.',
        ];
    }

    public function attributes() {
        return [
            'nombre' => 'nombre de estado',
        ];
    }

}
