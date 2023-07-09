<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * @property string $id
 * @property HeadlessModel $model
 * @property array $attributes
 * @property User $user
 */
class HeadlessModelInstance extends Model
{
    use HasFactory, HasUuids;

    public $guarded = [];

    public $casts = [
        'attributes' => 'json',
    ];

    /**
     * @return HasOne<HeadlessModel>
     */
    public function model(): HasOne
    {
        return $this->hasOne(
            related: HeadlessModel::class,
            foreignKey: 'id',
            localKey: 'model_id'
        );
    }

    /**
     * @return HasOneThrough<User>
     */
    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(
            related: User::class,
            through: HeadlessModel::class,
            firstKey: 'id',
            secondKey: 'id',
            localKey: 'model_id',
            secondLocalKey: 'user_id',
        );
    }
}
