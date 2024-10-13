<?php

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
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'aportaciones' => 'required',
        ];
    }

    // public function messages() {
    //     return [

    //     ];
    // }

}
