<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'RedaAli',
            'email' => 'reda@example.com',
            'password' => Hash::make('105090'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'MohamedAref',
            'email' => 'mohamed@example.com',
            'password' => Hash::make('105090'),
            'role' => 'moderator'
        ]);
        factory(User::class, 50)->create();
    }
}
