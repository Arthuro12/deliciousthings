<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreateArtisanRequest extends FormRequest
{
    private function shouldRequireAddress(): bool
    {
        $address = $this->input('first_address', []);

        return collect($address)->contains(function ($value, $key) {
            return ! in_array($key, ['address_line_2', 'shows_full_address'], true)
                && $value !== null
                && $value !== '';
        });
    }

    public function authorize(): bool
    {
        return $this->user()?->artisan === null;
    }

    public function rules(): array
    {
        $requireAddress = $this->shouldRequireAddress();

        return [
            'name' => ['required', 'string', 'min:5', 'max:100', Rule::unique('artisans', 'name')],
            'company_name' => ['nullable', 'string', 'max:150'],
            'main_occupation' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string', 'max:200'],
            'about' => ['required', 'string', 'min:20', 'max:5000'],
            'average_rate' => ['required', 'numeric', 'min:0', 'max:999999'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'offers_delivery' => ['required', 'boolean'],
            'pick_up_on_site' => ['required', 'boolean'],
            'addresses' => ['nullable', 'array', 'size:0'],
            'medias' => ['nullable', 'array', 'size:0'],
            'first_address' => ['nullable', 'array:street,house_number,postal_code,city,country,address_line_2,shows_full_address'],
            'first_address.street' => [Rule::requiredIf($requireAddress), 'nullable', 'string', 'max:255'],
            'first_address.house_number' => [Rule::requiredIf($requireAddress), 'nullable', 'string', 'max:30'],
            'first_address.postal_code' => [Rule::requiredIf($requireAddress), 'nullable', 'string', 'max:20'],
            'first_address.city' => [Rule::requiredIf($requireAddress), 'nullable', 'string', 'max:100'],
            'first_address.country' => [Rule::requiredIf($requireAddress), 'nullable', 'string', 'max:100'],
            'first_address.address_line_2' => ['nullable', 'string', 'max:255'],
            'first_address.shows_full_address' => ['nullable', 'boolean'],
            'baked_goods' => ['required', 'array', 'min:1'],
            'baked_goods.*.key' => ['required', 'string', 'exists:baked_goods,key'],
            'baked_goods.*.name' => ['required', 'string'],
            'baked_goods.*.label' => ['required', 'string'],
            'dietary_options' => ['nullable', 'array'],
            'dietary_options.*.key' => ['required', 'string', 'exists:dietary_options,key'],
            'dietary_options.*.name' => ['required', 'string'],
            'dietary_options.*.label' => ['required', 'string'],
            'gallery' => ['nullable', 'array', 'max:6'],
            'gallery.*' => [File::image()->max(3072)],
        ];
    }
}
