<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMovie extends Model
{
    protected $fillable = [
        'user_id',
        'tmdb_id',
        'title',
        'poster_path',
        'runtime',
        'status',
        'rating',
        'review',
        'is_favorite'
    ];

    // Relação: Um filme salvo pertence a um usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
