<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservingTime extends Model
{
    protected $fillable = ['start', 'end'];

    // public function getStartAttribute($value)
    // {
    //     return ((int) $value > 12) ? ((int) $value - 12) . ' PM' : (int) $value . ' Am';
    // }

    // public function getEndAttribute($value)
    // {
    //     return ((int) $value > 12) ? ((int) $value - 12) . ' PM' : (int) $value . ' Am';
    // }
}
