<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $notificationTypes = ['Lajm', 'Konkurs', 'Komunikatë'];
        $titles = [
            'Lajm' => [
                'Njoftim i rëndësishëm',
                'Informacion i ri',
                'Lajme të freskëta',
            ],
            'Konkurs' => [
                'Hapet konkursi i ri',
                'Mundësi për aplikim',
                'Fondet e reja të disponueshme',
            ],
            'Komunikatë' => [
                'Njoftim zyrtar',
                'Komunikatë e rëndësishme',
                'Informacion për publikun',
            ],
        ];

        $type = $this->faker->randomElement($notificationTypes);

        return [
            'imageUrl' => $this->faker->optional(0.7)->imageUrl(800, 400, 'notifications'), // 70% chance of having an image
            'datetime' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'title' => $this->faker->randomElement($titles[$type]),
            'description' => $this->generateDescription($type),
            'notificationType' => $type,
        ];
    }

    protected function generateDescription(string $type): string
    {
        $descriptions = [
            'Lajm' => "Informojmë publikun për {$this->faker->sentence(6)}",
            'Konkurs' => "Aftësoheni për të aplikuar në konkursin {$this->faker->word()} që mbulon {$this->faker->sentence(4)}",
            'Komunikatë' => "Njoftohet se {$this->faker->sentence(10)}",
        ];

        return $descriptions[$type];
    }

    public function lajm(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'notificationType' => 'Lajm',
                'title' => $this->faker->randomElement(['Njoftim i rëndësishëm', 'Informacion i ri', 'Lajme të freskëta']),
                'description' => "Informojmë publikun për {$this->faker->sentence(6)}",
            ];
        });
    }

    public function konkurs(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'notificationType' => 'Konkurs',
                'title' => $this->faker->randomElement(['Hapet konkursi i ri', 'Mundësi për aplikim', 'Fondet e reja të disponueshme']),
                'description' => "Aftësoheni për të aplikuar në konkursin {$this->faker->word()} që mbulon {$this->faker->sentence(4)}",
            ];
        });
    }

    public function komunikate(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'notificationType' => 'Komunikatë',
                'title' => $this->faker->randomElement(['Njoftim zyrtar', 'Komunikatë e rëndësishme', 'Informacion për publikun']),
                'description' => "Njoftohet se {$this->faker->sentence(10)}",
            ];
        });
    }

    public function withoutImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'imageUrl' => null,
        ]);
    }

    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'datetime' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
        ]);
    }

    public function future(): static
    {
        return $this->state(fn (array $attributes) => [
            'datetime' => $this->faker->dateTimeBetween('+1 day', '+1 year'),
        ]);
    }
}
