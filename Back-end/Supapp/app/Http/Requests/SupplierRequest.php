<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Suppliers;

class SupplierRequest extends FormRequest
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
          'name' => 'required|string',
          'cnpj' => 'required|cnpj',
          'address' => 'required|string',
          'phone' => 'required|telefone|string'
        ];
    }

    public function messages(){

        return[
          'name.unique' => 'Este nome ja existe',
          'name.required' => 'Insira um nome valido',
          'cnpj.unique' => 'Este cnpj ja existe',
          'cnpj.required' => 'Insira um cnpj valido',
          'address.unique' => 'Este endereco ja existe',
          'address.required' => 'Insira um endereco valido',
          'phone.required' => 'Insira um telefone valido',
          'phone.unique' => 'Este numero de telefone ja existe'
        ];
    }




    protected function failedValidation(Validator $validator)
    {
      throw new
      HttpResponseException(response()->json($validator->errors(), 422));
    }
}
