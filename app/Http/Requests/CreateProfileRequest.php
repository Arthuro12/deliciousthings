<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'string|required|max:5',
            'company_name' => 'nullable|string',
            'e164phone' => 'nullable|string',
            'email' => 'required|string',
            'biography' => 'nullable|string',
            'average_rate' => 'string|required',
            'website_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'offers_delivery' => 'boolean',
            'address' => 'array:street,house_number,postal_code,city,country,address_line_2',
            'address.street' => 'nullable|string',
            'address.house_number' => 'nullable|string',
            'address.postal_code' => 'nullable|string',
            'address.city' => 'nullable|string',
            'address.country' => 'nullable|string',
            'address.addres_line_2' => 'nullable|string',
            'speciality' => 'array:key,name,label',
            'speciality.key' => 'required|string',
            'speciality.name' => 'required|string',
            'speciality.label' => 'required|string',
        ];
    }
}