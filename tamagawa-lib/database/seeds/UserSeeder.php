<?php

use Illuminate\Database\Seeder;
use App\User;
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
        factory(User::class)->create([
            'name' => 'Tamagawa',
            'email' => 'tamagawa@example.com',
            'password' => Hash::make('password'),
        ]);

        factory(User::class)->create([
            'name' => 'TestUser',
            'email' => 'test_user@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
