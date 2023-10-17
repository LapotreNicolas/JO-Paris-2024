<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sport>
 */
class SportFactory extends Factory
{
    public static array $listeSports = array("Athlétisme", "Aviron", "Badminton", "Basketball", "Basketball 3×3", "Boxe",
        "Canoë sprint", "Canoë-kayak slalom", "Cyclisme sur piste", "Cyclisme sur route", "BMX freestyle",
        "BMX racing", "Mountain bike (VTT)", "Escrime", "Football", "Golf", "Gymnastique artistique",
        "Gymnastique rythmique", "Trampoline", "Haltérophilie", "Handball", "Hockey", "Judo", "Lutte",
        "Pentathlon moderne", "Rugby", "Natation", "Natation artistique", "Natation marathon", "Plongeon",
        "Waterpolo", "Sports équestres", "Taekwondo", "Tennis", "Tennis de table", "Tir", "Tir à l’arc",
        "Triathlon", "Voile", "Volleyball", "Volleyball de plage", "Breaking","Escalade sportive", "Skateboard",
        "Surf");

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
        $sport = $this->faker->unique->randomElement($this::$listeSports);
        $startDate = '2024-07-26';
        $interval = '+17 days';
        return [
            'nom' => $sport,
            'description' => $this->faker->paragraph,
            'annee_ajout' => $this->faker->numberBetween(0, 32) * 4 + 1896,
            'nb_disciplines' => $this->faker->numberBetween(1, 10),
            'nb_epreuves' => $this->faker->numberBetween(1, 10),
            'date_debut' => $startDate,
            'date_fin' => $this->faker->dateTimeInInterval($startDate, $interval),
            'created_at' => $createAt,
            'updated_at' => $this->faker->dateTimeInInterval(
                $startDate,
                $interval = $createAt->diff(new DateTime('now'))->format("%R%a days"),
            ),
        ];
    }
}
