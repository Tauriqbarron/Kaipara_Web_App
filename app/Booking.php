<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['client_id', 'booking_type_id', 'description', 'date', 'start_time', 'finish_time',
        'status','street', 'suburb', 'city', 'postcode','number_of_staff', 'available_slots'];

    public function client() {

        return $this->belongsTo('App\Clients', 'client_id', 'id');
    }

    public function booking_type() {

        return $this->belongsTo('App\Booking_Types', 'booking_type_id', 'id');
    }

    public function staff_Assignment() {

        return $this->hasMany('App\Staff_Assignment');
    }
}
