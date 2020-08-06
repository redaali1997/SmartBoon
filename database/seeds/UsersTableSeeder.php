<?php

use App\Order;
use App\User;
use Illuminate\Database\Seeder;

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
            'email' => 'reda@example.com',
            'role' => 'admin'
        ]);

        factory(User::class)->create([
            'email' => 'mohamed@example.com',
            'role' => 'moderator'
        ]);

        factory(User::class)->create([
            'email' => 'ahmed@example.com',
            'role' => 'student'
        ]);

        // factory(User::class, 50)->create()->each(function ($user) {
        //     $user->orders()->save(factory(Order::class)->make([
        //         'created_at' => '2010-10-04 00:00:00'
        //     ]));
        // });
    }
}
