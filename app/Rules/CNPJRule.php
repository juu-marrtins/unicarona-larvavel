<?php

namespace App\Rules;

use App\Helpers\Validation\Validator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CNPJRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $validator = new Validator();
            $validator->validateCNPJ($value);
        } catch (\Exception $e) {
            $fail('O CNPJ informado é inválido.');
        }
    }
}
