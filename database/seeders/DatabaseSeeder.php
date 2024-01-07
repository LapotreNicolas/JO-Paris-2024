<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Athlete;
use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Iorka',
            'email' => 'iorka@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(4),
            'is_admin' => true,
        ]);

        \App\Models\User::factory(10)->create();

        $this->call(AthleteSeeder::class);
        $this->call(SportSeeder::class);

        for ($i = 1 ; $i < count(Sport::all()) ; $i++) {
            for ($j = 1 ; $j < count(Athlete::all()) ; $j++) {
                if (rand(0,10) > 7) {
                    DB::table("classement")->insert([
                        "sport_id" => $i,
                        "athlete_id" => $j,
                        "rang" => rand(1, 50),
                        "performance" => Str::random(30)
                    ]);
                }
            }
        }
    }
}
