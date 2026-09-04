<?php

namespace App\Http\Requests\ServiceRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'occasion' => [
                'nullable',
                'string',
                'max:100',
            ],

            'event_date' => [
                'nullable',
                'date',
                'after_or_equal:today',
            ],

            'event_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'participants' => [
                'nullable',
                'integer',
                'min:1',
                'max:10000',
            ],

            'location_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'budget_min' => [
                'nullable',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'budget_max' => [
                'nullable',
                'numeric',
                'gte:budget_min',
                'max:99999999.99',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            'fulfillment_method' => [
                'nullable',
                'string',
                'max:50',
            ],

            'style' => [
                'array',
                'max:10',
            ],

            'style.*' => [
                'string',
                'max:50',
            ],

            'flavors' => [
                'array',
                'max:10',
            ],

            'flavors.*' => [
                'string',
                'max:50',
            ],

            'requirements' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }
}