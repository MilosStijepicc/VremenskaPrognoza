<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    public function run(): void
    {
        $cityName = $this->command->ask('Unesite ime grada');

        if ($cityName === null) {
            $this->command->getOutput()->error("Morate unijeti ime grada");
            return;
        }

        $temperature = $this->command->ask('Unesite temperaturu?');

        if ($temperature === null) {
            $this->command->getOutput()->error("Morate unijeti temperaturu");
            return;
        }

        $city = City::where('name', $cityName)->first();

        if (!$city) {
            $this->command->getOutput()->error("Grad ne postoji u bazi!");
            return;
        }

        $exists = Weather::where('city_id', $city->id)->exists();

        if ($exists) {
            $this->command->getOutput()->error("Weather za taj grad već postoji!");
            return;
        }

        Weather::create([
            'city_id' => $city->id,
            'temperature' => $temperature,
        ]);

        $this->command->getOutput()->info("Uspješno ste unijeli novi weather zapis!");
    }
}
