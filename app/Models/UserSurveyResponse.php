<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'satisfaction_rating',
        'feedback',
        'would_recommend',
        'improvements',
    ];

    protected $casts = [
        'would_recommend' => 'boolean',
        'satisfaction_rating' => 'integer',
    ];

    /**
     * Get the user that submitted the survey
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
