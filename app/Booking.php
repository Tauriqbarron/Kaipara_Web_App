<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['client_id', 'booking_type_id', 'description', 'date','end_date', 'start_time', 'finish_time',
        'status','street', 'suburb', 'city', 'postcode','staff_needed', 'available_slots', 'price'];

    public function client() {
        return $this->belongsTo('App\Clients', 'client_id', 'id');
    }

    public function booking_type() {

        return $this->belongsTo('App\Booking_Types', 'booking_type_id', 'id');
    }

    public function staff_assignments() {

        return $this->hasMany('App\Staff_Assignment');
    }
}
