<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
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
            'nombre' => 'required|string|max:50|unique:estados,nombre|regex: /^[\pL\s]+$/u',
            'capital' => 'required|string|max:60|unique:estados,capital|regex: /^[\pL\s]+$/u',
            'video' => 'required|string|unique:estados,video',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp',
            'triptico' => 'required|file|mimes:pdf',
            'guia' => 'required|file|mimes:pdf',
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

}
