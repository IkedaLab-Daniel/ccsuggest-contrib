<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recommendation;
use App\Models\TechField;

class RecommendationSeeder extends Seeder
{
    public function run(): void
    {
        // For each student, generate 3 recommendations
        $students = User::whereHas('roles', fn($q) => $q->where('name','student'))->get();
        $fields   = TechField::pluck('id')->all();

        foreach ($students as $user) {
            // choose 3 distinct tech fields
            $pick = collect($fields)->shuffle()->take(3);

            foreach ($pick as $fieldId) {
                Recommendation::updateOrCreate(
                    ['user_id' => $user->id, 'tech_field_id' => $fieldId],
                    ['score'   => fake()->randomFloat(2, 0.60, 1.00)]
                );
            }
        }
    }
}
