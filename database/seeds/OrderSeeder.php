<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 6
        ]);

        Order::create([
            'user_id' => 7
        ]);

        Order::create([
            'user_id' => 8
        ]);

        Order::create([
            'user_id' => 9
        ]);
    }
}
