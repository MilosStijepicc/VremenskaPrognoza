<?php
namespace Database\Seeders;
use App\Models\City;
use Faker\Factory;
use Illuminate\Database\Seeder;
class CitySeeder extends Seeder
{
    public function run(): void
    { $amount = $this->command->ask('Koliko gradova zelite da napravite?', 100);

        $faker = Factory::create();

        $this->command->getOutput()->progressStart($amount);

        for ($i = 0; $i < $amount; $i++)
        {
            City::create([ 'name' => $faker->unique()->city(), ]);
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
