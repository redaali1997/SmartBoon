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
            'role' => 'admin'
        ]);

        factory(User::class)->create([
            'name' => 'MohamedAref',
            'email' => 'mohamed@example.com',
            'role' => 'moderator'
        ]);

        factory(User::class)->create([
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'role' => 'student'
        ]);
    }
}
