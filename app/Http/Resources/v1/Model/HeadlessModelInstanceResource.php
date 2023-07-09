<?php

namespace App\Http\Resources\v1\Model;

use App\Models\HeadlessModelInstance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeadlessModelInstanceResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string,string>
     */
    public function toArray(Request $request): array
    {
        /** @var HeadlessModelInstance $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            ...$model->attributes,
        ];
    }
}
