<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    public function run(): void
    {
        $city = $this->command->ask('Unesite ime grada');

        if ($city === null) {
            $this->command->getOutput()->error("Morate unijeti ime grada");
            return;
        }

        $temperature = $this->command->ask('Unesite temperaturu?');

        if ($temperature === null) {
            $this->command->getOutput()->error("Morate unijeti temperaturu");
            return;
        }

        $exists = Weather::where('city', $city)->exists();

        if ($exists) {
            $this->command->getOutput()->error("Grad već postoji u bazi!");
            return;
        }

        Weather::create([
            'city' => $city,
            'temperature' => $temperature,
        ]);

        $this->command->getOutput()->info("Uspjesno ste unijeli novi grad!");
    }
}
