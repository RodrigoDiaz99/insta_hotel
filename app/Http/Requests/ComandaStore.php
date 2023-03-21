<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComandaStore extends FormRequest
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
            'llave_comanda'=>'required',
            'room_id'=>'required',
            'clave'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'llave_comanda.required' => 'El campo de la key es obligatorio',
            'room_id.required' => 'El campo "Habitacion" es obligatorio.',
        ];
    }
}
