<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteRequest extends FormRequest
{

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

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
            'cedula' => 'required|max:50|unique:clientes',
            'nombre' => 'required|max:50',
            'tlf_pago_movil' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'cedula.required' => 'La cedula es requerida',
            'cedula.max' =>'La cedula no puede ser mayor a :max caracteres.',
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' =>'El nombre no puede ser mayor a :max caracteres.',
            'cedula.unique' => 'la cedula ya existe'
        ];
    }
}
