<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'location',
        'programs',
        'tech_fields',
        'description'
    ];

    protected $casts = [
        'tech_fields' => 'array'
    ];

    /**
     * Get universities that match the given tech fields
     */
    public static function getMatchingUniversities($techFields, $limit = 5)
    {
        $universities = self::all();
        $scored = [];

        foreach ($universities as $university) {
            $score = 0;
            $universityTechFields = $university->tech_fields ?? [];

            foreach ($techFields as $techField => $userScore) {
                if (isset($universityTechFields[$techField])) {
                    $fieldStrength = $universityTechFields[$techField];
                    // Direct = 3 points, Partial = 1 point
                    $multiplier = (stripos($fieldStrength, 'Direct') !== false) ? 3 : 1;
                    $score += $userScore * $multiplier;
                }
            }

            if ($score > 0) {
                $scored[] = [
                    'university' => $university,
                    'score' => $score
                ];
            }
        }

        // Sort by score descending
        usort($scored, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return array_slice($scored, 0, $limit);
    }
}
