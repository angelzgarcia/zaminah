<?php
// FORM REQUEST ------ REGLAS DE VALIDACIONES

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCultureRequest extends FormRequest
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
                'max:80',
                'regex:/^[\pL\s]+$/u',
                Rule::unique('culturas', 'nombre') -> ignore($this -> route('culture') -> idCultura, 'idCultura'),
            ],
            'periodo' => 'required|max:255',
            'significado' => 'required|string',
            'descripcion' => 'required|string',
            'aportaciones' => 'required|string',
            'to_eliminate_imgs' => 'nullable|array|max:2|max:2|distinct',
            'to_eliminate_imgs.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'current_imgs_*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'new_imgs' => 'nullable|array|max:4|distinct',
            'new_imgs.*' => 'image|mimes:jpg,jpeg,png,webp',
        ];
    }

    public function messages() {
        return [
            'to_eliminate_imgs' => 'Debes dejar al menos una imagen',
            'to_eliminate_imgs.max' => 'Debes dejar al menos dos imagen',
            'nombre.required' => 'El nombre de la cultura es obligatorio',
            'descripcion.required' => 'La descripcion de la cultura es obligatoria',
            'fotos.required' => 'Carga entre 2 a 4 imagenes',
        ];
    }


}
