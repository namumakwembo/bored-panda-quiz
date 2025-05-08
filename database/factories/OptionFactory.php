<?php

namespace Database\Factories;

use App\Models\Outcome;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id' => Question::factory(),  // or Quiz::factory() if using quiz directly
            'outcome_id' => Outcome::factory(),
            'text' => $this->faker->sentence(3),
        ];
    }
}
