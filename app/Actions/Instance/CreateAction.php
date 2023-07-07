<?php

namespace App\Actions\Instance;

use App\Models\HeadlessModelInstance;

final readonly class CreateAction
{
    public function execute(string $modelId, array $attributes): string
    {
        return HeadlessModelInstance::create([
            'model_id' => $modelId,
            'attributes' => $attributes,
        ])->id;
    }
}
