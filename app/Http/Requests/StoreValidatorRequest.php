<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreValidatorRequest extends FormRequest
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
            'nome' => 'required|min:3|max:60',
            'SKU' => 'required|min:3|max:30',
            'quantidade' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => "O campo 'nome' é obrigatório.",
            'nome.min' => "O campo 'nome' precisa ter mais de 3 dígitos.",
            'nome.max' => "O campo 'nome' não pode ter mais de 60 dígitos.",
            'SKU.required' => "O campo 'SKU' é obrigatório.",
            'SKU.min' => "O campo 'SKU' precisa ter mais de 3 dígitos.",
            'SKU.max' => "O campo 'SKU' não pode ter mais de 30 dígitos.",
            'quantidade.required' => "O campo 'quantidade' é obrigatório.",
            'quantidade.integer' => "O campo 'quantidade' tem que ser um número inteiro válido.",
        ];
    }
}
