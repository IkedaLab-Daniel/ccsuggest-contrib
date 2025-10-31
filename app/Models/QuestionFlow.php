<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionFlow extends Model
{
    protected $fillable = [
        'question_id',
        'option_id',
        'next_question_id',
    ];

    /**
     * The question that this flow originates from.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * The option that triggers this flow (nullable for default).
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'option_id');
    }

    /**
     * The question this flow points to.
     */
    public function nextQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'next_question_id');
    }
}
