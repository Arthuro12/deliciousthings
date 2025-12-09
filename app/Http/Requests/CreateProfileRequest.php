<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

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
        $address = $this->data()['first_address'];
        $requiredAddressFields = array_any($address, function ($value) {
            return !is_null($value);
        });

        return [
            'username' => 'string|required|min:5',
            'company_name' => 'nullable|string',
            'main_occupation' => 'nullable|string',
            'e164phone' => 'nullable|string',
            'email' => 'required|string',
            'short_description' => 'nullable|string|max:200',
            'about' => 'required|string',
            'average_rate' => 'string|required',
            'website_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'offers_delivery' => 'boolean',
            'pick_up_on_site' => 'boolean',
            'addresses' => 'array|size:0',
            'first_address' => 'array:street,house_number,postal_code,city,country,address_line_2',
            'first_address.street' => Rule::requiredIf($requiredAddressFields),
            'first_address.house_number' => Rule::requiredIf($requiredAddressFields),
            'first_address.postal_code' => Rule::requiredIf($requiredAddressFields),
            'first_address.city' => Rule::requiredIf($requiredAddressFields),
            'first_address.country' => Rule::requiredIf($requiredAddressFields),
            'first_address.addres_line_2' => 'nullable|string',
            'specialities' => 'array',
            'specialities.*.key' => 'required|string',
            'specialities.*.name' => 'required|string',
            'specialities.*.label' => 'required|string',
            'diet_types' => 'array',
            'diet_types.*.key' => 'required|string',
            'diet_types.*.name' => 'required|string',
            'diet_types.*.label' => 'required|string',
            'medias' => 'array|size:0',
            'gallery' => 'array|between:3,6',
            'gallery.*' => File::image(),
        ];
    }
}