<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FibonacciRequest extends FormRequest
{

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
            'from' => "required|integer|min:0",
            'to' => "required|integer|gt:from",
        ];
    }

    public function messages(): array
    {
        return [
            'to.gt' => 'Поле :attribute должно быть больше чем поле "ОТ"',
        ];
    }

    public function attributes(): array
    {
        return [
            'from' => '"ОТ"',
            'to' => '"ДО"',
        ];
    }
}
