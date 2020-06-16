<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking_Types extends Model
{
     protected $fillable = ['description', 'rate'];

     public function bookings() {

         return $this->hasMany('App\Booking');
     }
}
