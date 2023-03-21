<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
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
            'fecha_entrada' => 'required',
            'hora_entrada' => 'required',
            'tarifa' => 'required',
            'cliente' => 'required'
        ];
    }

    public function attributes()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'El campo :attribute obligatorio',
        ];
    }

  
}
