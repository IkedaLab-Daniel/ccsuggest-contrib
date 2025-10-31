<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recommendation extends Model
{
    protected $fillable = [
        'user_id',
        'tech_field_id',
        'score',        // 0 – 1 float
    ];

    protected $casts = [
        'score' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function techField(): BelongsTo
    {
        return $this->belongsTo(TechField::class);
    }
}
