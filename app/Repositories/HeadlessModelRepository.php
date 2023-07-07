<?php

namespace App\Repositories;

use App\Models\HeadlessModel;
use Illuminate\Support\Collection;

class HeadlessModelRepository
{
    public function findById(string $id): HeadlessModel
    {
        // This call is automatically tenanted by a global scope
        return HeadlessModel::findOrFail($id);
    }

    public function getAll(): Collection
    {
        // This call is automatically tenanted by a global scope
        return HeadlessModel::all();
    }
}
