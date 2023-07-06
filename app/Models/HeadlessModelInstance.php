<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $id
 * @property HeadlessModel $model
 * @property array $attributes
 */
class HeadlessModelInstance extends Model
{
    use HasFactory, HasUuids;

    public $guarded = [];

    public $casts = [
        'attributes' => 'json',
    ];

    public function model(): HasOne
    {
        return $this->hasOne(
            related: HeadlessModel::class,
            foreignKey: 'id',
            localKey: 'model_id'
        );
    }
}
