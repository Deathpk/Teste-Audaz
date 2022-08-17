<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListFaresRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'operatorId' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'operatorId.required' => 'O codigo do operador é obrigatório.'
        ];
    }
}
