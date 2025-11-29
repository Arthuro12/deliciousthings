<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileList implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('The :attribute must not be empty.');
        } elseif (count($value) < 3) {
            $fail('The minimum number of uploaded files should be 3.');
        } elseif (count($value) > 7) {
            $fail('The maximum number of uploaded files should be 3.');
        }
    }
}