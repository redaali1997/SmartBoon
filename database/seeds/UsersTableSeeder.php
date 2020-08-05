<?php

use App\Order;
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

        factory(User::class)->create([
            'name' => 'RedaAli',
            'email' => 'reda@example.com',
            'role' => 'admin',
            'password' => Hash::make("102010")
        ]);

        factory(User::class)->create([
            'name' => 'MohamedAref',
            'email' => 'mohamed@example.com',
            'role' => 'moderator',
            'password' => Hash::make("102010")
        ]);

        factory(User::class)->create([
            'name' => 'MichealScott',
            'email' => 'prisonmike@example.com',
            'role' => 'student',
            'activated' => true,
            'password' => Hash::make("102010")
        ]);
    }
}
