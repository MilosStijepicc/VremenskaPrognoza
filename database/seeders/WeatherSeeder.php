<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    public function run(): void
    {
        $cities = City::all();

        foreach ($cities as $city) {

            $exists = Weather::where('city_id', $city->id)->exists();

            if ($exists) {
                continue;
            }

            Weather::create([
                'city_id' => $city->id,
                'temperature' => rand(-10, 40),
            ]);
        }

        $this->command->info('Weather tabela uspješno popunjena!');
    }
}
