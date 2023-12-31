<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

use function authUser;

/**
 * @property string $id
 * @property string $name
 * @property User $user
 * @property array $attributes
 * @property Collection $instances
 */
class HeadlessModel extends Model
{
    use HasFactory, HasUuids;

    public $guarded = [];

    public $casts = [
        'attributes' => 'json',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(function (Builder $query) {
            // Ensure an authenticated user can only see their models
            if (auth()->check()) {
                $query->where('user_id', authUser()->id);
            }
        });
    }

    /**
     * @return HasOne<User>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return HasMany<HeadlessModelInstance>
     */
    public function instances(): HasMany
    {
        return $this->hasMany(
            related: HeadlessModelInstance::class,
            foreignKey: 'model_id',
            localKey: 'id'
        );
    }
}
