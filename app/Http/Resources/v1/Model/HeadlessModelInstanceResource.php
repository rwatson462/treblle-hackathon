<?php

namespace App\Http\Resources\v1\Model;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeadlessModelInstanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            ...$this->resource->attributes,
        ];
    }
}
