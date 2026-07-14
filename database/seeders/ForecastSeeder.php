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

            $temperature = $faker->numberBetween(-10, 30);

            for ($i = 0; $i < 5; $i++) {


                if ($i > 0) {
                    $temperature += rand(-5, 5);
                }


                if ($temperature <= 1) {

                    $randomWeather = rand(0, 1);

                    if ($randomWeather == 0) {
                        $weatherType = 'snowy';
                    } else {
                        $weatherType = 'cloudy';
                    }


                } elseif ($temperature <= 10) {

                    $randomWeather = rand(0, 1);

                    if ($randomWeather == 0) {
                        $weatherType = 'rainy';
                    } else {
                        $weatherType = 'cloudy';
                    }


                } elseif ($temperature <= 15) {

                    $randomWeather = rand(0, 1);

                    if ($randomWeather == 0) {
                        $weatherType = 'cloudy';
                    } else {
                        $weatherType = 'sunny';
                    }


                } else {

                    $weatherType = 'sunny';

                }


                $probability = null;


                if ($weatherType == 'rainy' || $weatherType == 'snowy') {
                    $probability = rand(1, 100);
                }


                Forecast::create([
                    'city_id' => $city->id,
                    'temperature' => $temperature,
                    'date' => now()->addDays($i)->toDateString(),
                    'weather_type' => $weatherType,
                    'probability' => $probability,
                ]);

            }
        }
    }
}
