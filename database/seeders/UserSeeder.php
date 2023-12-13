<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');
        $dateOfBirth = $faker->dateTimeThisCentury->format('Y-m-d');

        for ($i = 0; $i < 4; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'username' => $faker->userName,
                'date_of_birth' => $dateOfBirth,
                'gender' => $faker->randomElement(['male', 'female']),
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => $faker->uuid,
                'role_id' => $faker->numberBetween(1, 1),
                // Add other fields and their respective faker methods
            ]);
        }
    }
}
