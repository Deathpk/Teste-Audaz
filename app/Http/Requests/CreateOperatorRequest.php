<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOperatorRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'code' => 'required|string'
        ];
    }

    public function  messages(): array
    {
        return [
            'code.required' => 'O código da operadora é obrigatório.',
            'code.string' => 'O código da operadora deve conter somente caracteres alfa numéricos.'
        ];
    }
}
