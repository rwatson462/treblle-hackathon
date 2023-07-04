<?php

namespace App\Http\Requests\Model;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'attributes.*' => 'string|max:255',
        ];
    }
}
