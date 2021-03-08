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
            'name' => 'TestUser1',
            'email' => 'test_user1@example.com',
            'password' => Hash::make('password'),
        ]);

        factory(User::class)->create([
            'name' => 'TestUser2',
            'email' => 'test_user2@example.com',
            'password' => Hash::make('password'),
        ]);

        factory(User::class)->create([
            'name' => 'TestUser3',
            'email' => 'test_user3@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
