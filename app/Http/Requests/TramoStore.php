<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TramoStore extends FormRequest
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
          'name'=>'required',

          'time'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El campo nombre del area es obligatorio',

            'time.required' => 'El campo de tiempo es obligatorio',

        ];
    }
}
