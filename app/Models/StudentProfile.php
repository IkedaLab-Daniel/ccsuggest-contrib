<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'date_of_birth',
        'gender',
        'gpa',
        'senior_high_grade',
        'interests',
    ];

    protected $casts = [
        'date_of_birth'       => 'date',
        'interests'           => 'array',
        'senior_high_grade'   => 'decimal:2',
        'gpa'                 => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
