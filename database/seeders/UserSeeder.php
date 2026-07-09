<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $amount = $this->command->ask('Koliko usera zelite da napravite?', 100);

        $faker = Factory::create();

        $this->command->getOutput()->progressStart($amount);

        for ($i = 0; $i < $amount; $i++) {

            // ovdje sam napravio svakog 10 korisnika adminom zbog nekog ajda da kazemo realnog omjera
            if ($i % 10 == 0) {
                $role = 'admin';
            } else {
                $role = 'user';
            }

            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('12345678'),
                'role' => $role,
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();

        $this->command->info("Kreirano {$amount} usera.");
    }
}
