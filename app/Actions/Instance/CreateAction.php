<?php

namespace App\Actions\Instance;

use App\Models\HeadlessModelInstance;

final readonly class CreateAction
{
    /**
     * @param string $modelId
     * @param array<string,string> $attributes
     * @return string
     */
    public function execute(string $modelId, array $attributes): string
    {
        return HeadlessModelInstance::create([
            'model_id' => $modelId,
            'attributes' => $attributes,
        ])->id;
    }
}
