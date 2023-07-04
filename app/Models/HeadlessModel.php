<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HeadlessModel extends Model
{
    use HasFactory, HasUuids;

    public $guarded = [];

    public $casts = [
        'attributes' => 'json',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
