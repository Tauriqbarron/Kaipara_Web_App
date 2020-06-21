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

    public function timesheet() {
        return $this->hasMany('App\Timesheet');
    }
    public function feedback() {
        return $this->hasMany('App\Feedback');
    }
    public function client_feedback() {
        return $this->hasMany('App\Client_Feedback');
    }

}
