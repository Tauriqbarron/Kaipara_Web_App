<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff_Assignment extends Model
{
    protected $fillable = ['staff_id', 'booking_id'];

    public function staff() {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function booking() {
        return $this->belongsTo('App\Booking', 'booking_id', 'id');
    }
}
