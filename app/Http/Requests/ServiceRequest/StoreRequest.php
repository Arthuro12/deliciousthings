<?php

namespace App\Http\Requests\ServiceRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => [
                'required',
                'string',
                'min:20',
                'max:2000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' =>
                'Beschreibe kurz, was du suchst.',

            'description.min' =>
                'Beschreibe deine Idee mit etwas mehr Details.',

            'description.max' =>
                'Die Beschreibung darf maximal 2.000 Zeichen enthalten.',
        ];
    }
}