<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class CreateFareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'operatorCode' => 'required|string',
            'value' => 'required|int'
        ];
    }

    public function messages(): array
    {
        return [
          'operatorCode.required' => 'O Código do Operador é obrigatório.',
          'operatorCode.string' => 'O Código do Operador deve conter somente caractéres alfa numéricos.',
          'value.required' => 'O valor da tarifa é obrigatório.',
          'value.int' => 'O valor da tarifa deve ser do tipo inteiro.'
        ];
    }

    public function getAttributes(): Collection
    {
        return collect($this->validated());
    }
}
