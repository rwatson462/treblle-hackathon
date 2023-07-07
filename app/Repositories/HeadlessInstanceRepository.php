<?php

namespace App\Repositories;

use App\Models\HeadlessModelInstance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HeadlessInstanceRepository
{
    public function findById(string $id): HeadlessModelInstance
    {
        // Note: adding whereHas('model') applies the tenant scope for us
        /** @var ?HeadlessModelInstance $model */
        $model = HeadlessModelInstance::query()
            ->where('id', $id)
            ->whereHas('model')
            ->first()
            ?->load('model');

        if ($model === null) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    public function delete(string $id): void
    {
        // Note: adding whereHas('model') applies the tenant scope for us
        $instance = HeadlessModelInstance::query()
            ->where('id', $id)
            ->whereHas('model')
            ->first();

        if ($instance === null) {
            throw new ModelNotFoundException();
        }

        $instance->delete();
    }
}
