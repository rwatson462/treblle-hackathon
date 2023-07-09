<?php

namespace App\Http\Resources\v1\Model;

use App\Models\HeadlessModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeadlessModelResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string,string>
     */
    public function toArray(Request $request): array
    {
        /** @var HeadlessModel $model */
        $model = $this->resource;

        return [
            'id'=>  $model->id,
            'name' => $model->name,
        ];
    }
}
