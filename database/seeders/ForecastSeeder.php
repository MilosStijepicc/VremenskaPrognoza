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

                Forecast::create([
                    'city_id' => $city->id,
                    'temperature' => $faker->numberBetween(-15, 40),
                    'date' => now()->addDays($i)->toDateString(),
                ]);
            }
        }
    }
}
