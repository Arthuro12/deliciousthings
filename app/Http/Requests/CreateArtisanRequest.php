<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreateArtisanRequest extends FormRequest
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
        $requireAddressFields = array_any($address, function ($value, $key) {
            if ($key == 'address_line_2') return false;
            return !is_null($value);
        });

        return [
            'name' => 'required|string|min:5',
            'company_name' => 'nullable|string',
            'main_occupation' => 'nullable|string',
            'short_description' => 'nullable|string|max:200',
            'about' => 'required|string',
            'average_rate' => 'required|string',
            'website_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'offers_delivery' => 'required|boolean',
            'pick_up_on_site' => 'required|boolean',
            'addresses' => 'array|size:0',
            'medias' => 'array|size:0',
            'first_address' => 'array:street,house_number,postal_code,city,country,address_line_2,shows_full_address',
            'first_address.street' => Rule::requiredIf($requireAddressFields),
            'first_address.house_number' => Rule::requiredIf($requireAddressFields),
            'first_address.postal_code' => Rule::requiredIf($requireAddressFields),
            'first_address.city' => Rule::requiredIf($requireAddressFields),
            'first_address.country' => Rule::requiredIf($requireAddressFields),
            'first_address.address_line_2' => 'nullable|string',
            'first_address.shows_full_address' => 'nullable|boolean',
            'baked_goods' => 'required|array',
            'baked_goods.*.key' => 'required|string',
            'baked_goods.*.name' => 'required|string',
            'baked_goods.*.label' => 'required|string',
            'dietary_options' => 'nullable|array',
            'dietary_options.*.key' => 'required|string',
            'dietary_options.*.name' => 'required|string',
            'dietary_options.*.label' => 'required|string',
            'gallery' => 'array|between:3,6',
            'gallery.*' => File::image(),
        ];
    }
}