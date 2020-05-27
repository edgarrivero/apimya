<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CuentaRequest extends FormRequest
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
            'num_cuenta' => 'numeric|required|unique:cuentas',
            'num_tarjeta' => 'nullable|unique:cuentas',
            'cliente_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido.',
            'numeric' => 'El :attribute debe ser numerico.',
            'unique' => 'El :attribute ya esta en uso.',          
        ];
    }
}
