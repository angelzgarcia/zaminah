<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreZoneRequest extends FormRequest
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
            'nombre' => 'required|unique:zonas,nombre|string|max:60',
            'significado' => 'required|alpha_num:ascii',
            'descripcion' => 'required|alpha_num:ascii',
            'acceso' => 'required|alpha_num:ascii',
            'de_dia' => 'required|string',
            'a_dia' => 'required|string',
            'de_hora' => 'required|string',
            'a_hora' => 'required|string',
            'costo' => 'required|numeric|max:1000',
            'contacto' => 'required|string',
            'estado' => 'required|exists:estados,idEstadoRepublica',
            'cultura' => 'required|exists:culturas,idCultura',
            'fotos' => 'required|array|min:2|max:4',
            'fotos.*' => 'image|mimes:jpg,jpeg,png,webp|distinct|max:10000',
            // 'direccion' => 'required|string|alpha_num:ascii',
        ];
    }

    public function messages() {
        return [
            'estado.exists' => 'Hubo problemas al encontrar el estado de la republica',
            'cultura.exists' => 'Hubo problemas al encontrar la cultura',
            'significado.alpha_num' => 'Se ingresaron carácteres no permitidos',
            'descripcion.alpha_num' => 'Se ingresaron carácteres no permitidos',
            'acceso.alpha_num' => 'Se ingresaron carácteres no permitidos',
            'fotos.max' => 'Sube como máximo 4 imagenes',
            'fotos.min' => 'Sube al menos 2 imagenes',
            'fotos.*.mimes' => 'No se permite el formato subido',
            'fotos.*.distinct' => 'Este archvio ya ha sido cargado',
            'fotos.*.max' => 'Archivo demasiado pesado, máximo 10MB',
            'costo.numeric' => 'Ingresa una cantidad válida',
            // 'direccion.string' => 'Tipo de dato no valido',
            // 'direccion.alpha_num' => 'Caracteres no validos',
        ];
    }


}
