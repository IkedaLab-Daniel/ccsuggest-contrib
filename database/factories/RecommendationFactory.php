<?php

namespace Database\Factories;

use App\Models\Recommendation;
use App\Models\User;
use App\Models\TechField;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendationFactory extends Factory
{
    protected $model = Recommendation::class;

    public function definition(): array
    {
        return [
            'user_id'       => User::inRandomOrder()->first()->id,
            'tech_field_id' => TechField::inRandomOrder()->first()->id,
            'score'         => $this->faker->randomFloat(2, 0.50, 1.00), // 0.50 – 1.00
        ];
    }
}
