<?php

namespace App\Http\Requests\v1\Model;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\ValidationRuleParser;

class CreateRequest extends FormRequest
{
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'attributes' => 'required|array',
            'attributes.*' => 'string|max:255',
        ];
    }

    public function passedValidation(): void
    {
        /**
         * For our simple purposes, we'll just make sure that the validation method
         * exists on the validator instance, e.g. $validator->required()
         */

        /** @var array<string,string> $validated */
        $validated = $this->validated('attributes');

        foreach ($validated as $rules) {
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
