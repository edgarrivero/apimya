<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DetFacturaRequest extends FormRequest
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
            'pago' => 'required',
            'factura_id' => 'required',
            'producto_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pago.required' => 'El Pago es requerido',
            'factura_id.required' => 'El codigo de Factura es requerido',
            'producto_id.required' => 'El codigo de Producto es requerido',
        ];
    }
}
