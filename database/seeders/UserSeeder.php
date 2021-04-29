<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->count(10)
        ->create();

        User::create([
            'name' => 'Abiodun Solomon',
            'is_admin' => true,
            'email' => 'abiodun@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'), // password
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'John Doe',
            'is_admin' => false,
            'email' => 'john@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'), // password
            'remember_token' => Str::random(10)
        ]);

    }
}
