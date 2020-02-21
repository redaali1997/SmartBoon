<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservingTime extends Model
{
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];
}
