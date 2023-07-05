<?php

namespace App\Http\Requests\v1\Model;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model_id' => 'required|string|max:255|exists:headless_models,id',
        ];
    }
}
