<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['agenda', 'minutes', 'presentation', 'report', 'other'];

        return [
            'title' => $this->faker->sentence(2),
            'url' => $this->faker->url(),
            'type' => $this->faker->randomElement($types),
            'conferenceId' => \App\Models\Conference::factory(),
        ];
    }

    public function forConference(\App\Models\Conference $conference): static
    {
        return $this->state(function (array $attributes) use ($conference) {
            return [
                'conferenceId' => $conference->id,
            ];
        });
    }

    public function agenda(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'agenda',
                'title' => 'Agenda: ' . $this->faker->words(3, true),
            ];
        });
    }

    public function minutes(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'minutes',
                'title' => 'Minutes: ' . $this->faker->words(3, true),
            ];
        });
    }

    public function presentation(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'presentation',
                'title' => $this->faker->catchPhrase(),
            ];
        });
    }
}
