<?php

namespace App\Rules;

use App\Helpers\Validation\Validator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailInstitutionalRule implements ValidationRule
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
            $validator->validateEmailInstitutional($value);
        } catch (\Exception $e) {
            $fail('O email informado não pertence a uma instituição acadêmica.');
        }
    }
}
