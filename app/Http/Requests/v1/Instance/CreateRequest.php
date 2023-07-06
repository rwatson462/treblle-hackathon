<?php

namespace App\Http\Requests\v1\Instance;

use App\Models\HeadlessModel;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    private HeadlessModel $model;

    public function authorize(): bool
    {
        // This will handily throw a 404 if the model doesn't belong to the user
        $this->model = HeadlessModel::findOrFail($this->route('uuid'));

        // So if we get here, the request is allowed to continue
        return true;
    }

    public function rules(): array
    {
        return $this->model->attributes;
    }
}
