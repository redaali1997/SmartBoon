<?php

use App\ReservingTime;
use Illuminate\Database\Seeder;

class TimeReservingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ReservingTime::class)->create([
            'start' => '19:00:00',
            'end' => '23:00:00'
        ]);
    }
}
