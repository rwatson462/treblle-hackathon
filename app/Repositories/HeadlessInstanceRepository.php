<?php

namespace app\Repositories;

use App\Models\HeadlessModelInstance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HeadlessInstanceRepository
{
    public function findById(string $id): HeadlessModelInstance
    {
        // Note: Because the HeadlessModel has a scope that restricts to the logged-in user, this is tenant-safe
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
}
