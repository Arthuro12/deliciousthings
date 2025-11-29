<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Rules\FileList;

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
        $address = $this->data()['address'];
        $requiredAddressFields = array_any($address, function ($value) {
            return !is_null($value);
        });

        return [
            'username' => 'string|required|min:5',
            'company_name' => 'nullable|string',
            'e164phone' => 'nullable|string',
            'email' => 'required|string',
            'biography' => 'nullable|string',
            'average_rate' => 'string|required',
            'website_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'offers_delivery' => 'boolean',
            'address' => 'array:street,house_number,postal_code,city,country,address_line_2',
            'address.street' => Rule::requiredIf($requiredAddressFields),
            'address.house_number' => Rule::requiredIf($requiredAddressFields),
            'address.postal_code' => Rule::requiredIf($requiredAddressFields),
            'address.city' => Rule::requiredIf($requiredAddressFields),
            'address.country' => Rule::requiredIf($requiredAddressFields),
            'address.addres_line_2' => 'nullable|string',
            'specialities' => 'array',
            'specialities.*.key' => 'required|string',
            'specialities.*.name' => 'required|string',
            'specialities.*.label' => 'required|string',
            'medias' => 'array|size:0',
            'gallery' => new FileList,
        ];
    }
}