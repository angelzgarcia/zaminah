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
            ],
            'periodo' => 'required|max:255',
            'significado' => 'required|max:255',
            'descripcion' => 'required|max:1500',
            'aportaciones' => 'required',
            'imgs_actuales' => ''
        ];
    }

    public function messages() {
        return [
            'significado' => ''
        ];
    }


}
