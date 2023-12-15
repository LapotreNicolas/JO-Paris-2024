<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Athlete>
 */
class AthleteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createAt = $this->faker->dateTimeInInterval(
            $start = '-6 months',
            $inter = '+ 180 days',
        );
        $startDate = '2024-07-26';
        $interval = '+17 days';
        return [
            'nom' => $this->faker->name,
            'nationalite' => $this->faker->randomElement(['France', 'Allemagne', 'Espagne', 'Italie', 'Anglais', 'Russe']),
            'age' => $this->faker->numberBetween(18, 60),
            'created_at' => $createAt,
            'updated_at' => $this->faker->dateTimeInInterval(
                $startDate,
                $interval = $createAt->diff(new DateTime('now'))->format("%R%a days"),
            ),
        ];
    }
}
