<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechField extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Questions associated with this tech field.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'tech_field_id', 'id');
    }

    /**
     * Recommendations for this field.
     */
    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class, 'tech_field_id', 'id');
    }
}
