<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TechField;


class Question extends Model
{
    protected $fillable = [
        'text',
        'type',
        'tech_field_id',
    ];

    /**
     * The options for single/multiple choice questions.
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }

    /**
     * The tech field this question belongs to (optional).
     */
    public function techField(): BelongsTo
    {
        return $this->belongsTo(TechField::class, 'tech_field_id', 'id');
    }

    /**
     * Outgoing flows (for branching logic).
     */
    public function flows(): HasMany
    {
        return $this->hasMany(QuestionFlow::class, 'question_id', 'id');
    }
}
