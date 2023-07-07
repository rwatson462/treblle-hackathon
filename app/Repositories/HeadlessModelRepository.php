<?php

namespace App\Repositories;

use App\Models\HeadlessModel;

class HeadlessModelRepository
{
    public function findById(string $id): HeadlessModel
    {
        return HeadlessModel::findOrFail($id);
    }
}
