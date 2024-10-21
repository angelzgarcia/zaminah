<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateZoneRequest extends FormRequest
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
                'max:60',
                Rule::unique('zonas', 'nombre') -> ignore($this -> route('zone') -> idZonaArqueologica, 'idZonaArqueologica'),
            ],
            'significado' => 'required|string',
            'descripcion' => 'required|string',
            'acceso' => 'required|string',
            'de_dia' => 'required|string',
            'a_dia' => 'required|string',
            'de_hora' => 'required|string',
            'a_hora' => 'required|string',
            'costo' => 'required|numeric|max:1000',
            'contacto' => 'required|string',
            'estado' => 'required|exists:estados,idEstadoRepublica',
            'cultura' => 'required|exists:culturas,idCultura',
            'current_imgs_*' => 'image|mimes:jpg,jpeg,png,webp|distinct|max:10000',
            'to_eliminate_imgs' => 'nullable|array|max:2',
            'to_eliminate_imgs.*' => 'image|mimes:jpg,jpeg,png,webp|distinct|max:10000',
            'new_imgs' => 'nullable|array|max:2',
            'new_imgs.*' => 'image|mimes:jpg,jpeg,png,webp|distinct|max:10000',
        ];
    }

    public function messages() {
        return [
            'estado.exists' => 'Hubo problemas al encontrar el estado de la republica',
            'cultura.exists' => 'Hubo problemas al encontrar la cultura',
            // 'significado.alpha_num' => 'Se ingresaron carácteres no permitidos',
            // 'descripcion.alpha_num' => 'Se ingresaron carácteres no permitidos',
            // 'acceso.alpha_num' => 'Se ingresaron carácteres no permitidos',
            'to_eliminate_imgs.max' => 'Sube como máximo 4 imagenes',
            'new_imgs_imgs.max' => 'Sube como máximo 4 imagenes',
            'new_imgs_imgs.min' => 'Sube al menos 2 imagenes',
            // 'to_eliminate_imgs.min' => 'Sube al menos 2 imagenes',
            'to_eliminate_imgs.*.mimes' => 'No se permite el formato subido',
            'new_imgs.*.mimes' => 'No se permite el formato subido',
            'to_eliminate_imgs.*.distinct' => 'Este archvio ya ha sido cargado',
            'new_imgs_imgs.*.distinct' => 'Este archvio ya ha sido cargado',
            'to_eliminate_imgs.*.max' => 'Archivo demasiado pesado, máximo 10MB',
            'new_imgs_imgs.*.max' => 'Archivo demasiado pesado, máximo 10MB',
            'costo.numeric' => 'Ingresa una cantidad válida',
        ];
    }

}
