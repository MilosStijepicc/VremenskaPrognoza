<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = $this->command->ask('Unesite email!');
        if($email === null)
        {
            $this->command->getOutput()->error("Niste unijeli email!");
            return;
        }
        $user = User::where('email', $email)->first();
        if($user !== null)
        {
            $this->command->getOutput()->error("Korisnik sa email adresom {$email} već postoji!");
            return;
        }

        $name = $this->command->ask('Unesite korisnicko ime!');
        if($name === null)
        {
            $this->command->getOutput()->error("Niste unijeli korisnicko ime!");
            return;
        }
        $password = $this->command->ask('Unesite lozinku!');
        if($password === null)
        {
            $this->command->getOutput()->error("Niste unijeli lozinku!");
            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);


    }
}
