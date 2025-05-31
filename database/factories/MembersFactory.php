<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Members>
 */
class MembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = [
            'Chairperson',
            'Vice Chair',
            'Secretary',
            'Treasurer',
            'Board Member',
            'Committee Head',
            'Project Manager',
            'Advisor',
        ];

        $titles = ['Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.'];

        return [
            'title' => $this->faker->randomElement($titles),
            'name' => $this->faker->name(),
            'position' => $this->faker->randomElement($positions),
            'email' => $this->faker->unique()->safeEmail(),
            'orderNr' => $this->faker->unique()->numberBetween(1, 100),
            'imageUrl' => $this->faker->optional(0.8)->imageUrl(200, 200, 'people'),
        ];
    }

    public function withoutImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'imageUrl' => null,
        ]);
    }

    public function withPosition(string $position): static
    {
        return $this->state(fn (array $attributes) => [
            'position' => $position,
        ]);
    }

    public function withTitle(string $title): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $title,
        ]);
    }

    public function withOrderNr(int $orderNr): static
    {
        return $this->state(fn (array $attributes) => [
            'orderNr' => $orderNr,
        ]);
    }
}
