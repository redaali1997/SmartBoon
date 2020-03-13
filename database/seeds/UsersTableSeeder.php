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
        User::create([
            'name' => 'MichealScott',
            'email' => 'prisonmike@example.com',
            'password' => Hash::make('102010'),
            'room_number' => '1',
            'boon_number' => '1000',
            'role' => 'student'
        ]);
        factory(User::class, 50)->create()->each(function ($user) {
            $user->orders()->save(factory(Order::class)->make([
                'created_at' => '2010-10-04 00:00:00'
            ]));
        });
    }
}
