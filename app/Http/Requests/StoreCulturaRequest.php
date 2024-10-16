<?php
// FORM REQUEST ----- REGLAS DE VALIDACION

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCulturaRequest extends FormRequest
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
            'nombre' => 'required|string|max:80|unique:culturas,nombre|regex: /^[\pL\s]+$/u',
            'periodo' => 'required|max:255',
            'significado' => 'required',
            'descripcion' => 'required',
            'fotos' => 'required|array|min:2|max:4',
            'fotos.*' => 'image|mimes:jpeg,jpg,png,gif,webp',
            'aportaciones' => 'required',
        ];
    }

    public function messages() {
        return [
            'nombre.required' => 'El nombre de la cultura es obligatorio',
            'descripcion.required' => 'La descripcion de la cultura es obligatoria',
            'fotos.required' => 'Carga entre 2 a 4 imagenes',
            'fotos.min' => 'Carga al menos dos imagenes',
            'fotos.max' => 'Carga como máximo 4 imagenes'
        ];
    }

    public function attributes() {
        return [
            'nombre' => 'cultura',
        ];
    }

}
