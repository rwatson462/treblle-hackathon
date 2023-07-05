<?php

namespace App\Http\Requests\Model;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\ValidationRuleParser;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'attributes.*' => 'string|max:255',
        ];
    }

    public function passedValidation(): void
    {
        /**
         * For our simple purposes, we'll just make sure that the validation method
         * exists on the validator instance, e.g. $validator->required()
         */
        foreach ($this->validated()['attributes'] as $rules) {
            foreach (explode('|', $rules) as $rule) {
                $rule = ValidationRuleParser::parse($rule)[0] ?? null;
                if (!method_exists($this->getValidatorInstance(), "validate$rule")) {
                    // ERROR
                    throw new ValidationException($this->getValidatorInstance());
                }
            }
        }
    }
}
