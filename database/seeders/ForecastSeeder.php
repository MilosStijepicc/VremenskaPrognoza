<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forecast;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $cities = City::all();

        foreach ($cities as $city) {

            for ($i = 0; $i < 5; $i++) {
                $weatherType = Forecast::WEATHER_TYPES[rand(0, 2)];
                $probability = null;

                if($weatherType === 'rainy' || $weatherType === 'snowy') {
                    $probability = rand(1, 100);
                }

                Forecast::create([
                    'city_id' => $city->id,
                    'temperature' => $faker->numberBetween(-15, 40),
                    'date' => now()->addDays($i)->toDateString(),
                    'weather_type' => $weatherType,
                    "probability" => $probability,
                ]);
            }
        }
    }
}
