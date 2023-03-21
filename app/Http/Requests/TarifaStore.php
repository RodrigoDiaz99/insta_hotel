<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarifaStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descripcion_corta'=>'required',
            'descripcion_larga'=>'required',
            'date_inicio'=>'required',
            'date_fin'=>'required',
            'importe'=>'required',
            'suplemento'=>'required',
            'time_limpieza'=>'required',
            'room_types_id'=>'required'
            // 'time_lunes'=>'required',
            // 'time_martes'=>'required',
            // 'time_miercoles'=>'required',
            // 'time_jueves'=>'required',
            // 'time_viernes'=>'required',
            // 'time_sabado'=>'required',
            // 'time_domingo'=>'required'

        ];

    }
    public function messages()
    {
        return [
            'descripcion_corta.required'=> 'El campo descripcion corta es obligatorio',
            'descripcion_larga.required'=> 'El campo descripcion larga es obligatorio',
            'date_inicio.required'=> 'El campo fecha de inicio es obligatorio',
            'date_fin.required'=> 'El campo fecha fin es obligatorio',
            'importe.required'=> 'El campo importe es obligatorio',
            'suplemento.required'=> 'El campo suplemento es obligatorio',
            'time_limpieza.required'=> 'El campo Tiempo Limpieza es obligatorio',
            'room_types_id.required'=>'El campo tipo habitacion es obligatorio',




        ];
    }
}
