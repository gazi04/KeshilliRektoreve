<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }

        public function withDocuments(int $count = 1): static
    {
        return $this->afterCreating(function (\App\Models\Conference $conference) use ($count) {
            \App\Models\Document::factory()
                ->count($count)
                ->forConference($conference)
                ->create();
        });
    }

    public function past(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
            ];
        });
    }

    public function future(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => $this->faker->dateTimeBetween('+1 day', '+1 year'),
            ];
        });
    }
}
