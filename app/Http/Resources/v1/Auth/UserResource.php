<?php

namespace App\Http\Resources\v1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string,string>
     */
    public function toArray(Request $request): array
    {
        /** @var User $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
        ];
    }
}
