<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['client_id', 'booking_type_id', 'description', 'date', 'start_time', 'status','street', 'suburb', 'city', 'postcode'];
}
