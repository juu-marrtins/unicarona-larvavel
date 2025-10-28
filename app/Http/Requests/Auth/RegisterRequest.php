<?php

namespace App\Http\Requests\Auth;

use App\Rules\CNPJRule;
use App\Rules\CPFRule;
use App\Rules\EmailInstitutionalRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $fieldsToClean = ['cpf', 'cnpj'];
        $cleanData = []; foreach ($fieldsToClean as $field) {
        if ($this->has($field) && !empty($this->input($field))) {
            $cleanData[$field] = preg_replace('/\D/', '', $this->input($field));
            }
        } 
        if (!empty($cleanData)) {
            $this->merge($cleanData);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new EmailInstitutionalRule()],
            'password'=> ['required', 'string', 'min:8'],
            'ra'=> ['required', 'string', 'min:8'],
            'course' => ['required', 'string', 'max:255'],
            'phone'=> ['required', 'string', 'max:11'],
            'user_type'=> ['required', 'string', 'in:driver,passenger,both'],
            'user_title'=> ['required', 'string', 'in:student,professor,employee'],
            'cpf'=> ['required', 'string', 'max:14', new CPFRule()],
            'cnpj' => ['required', 'string', 'max:18', new CNPJRule()],
        ];
    }
}
