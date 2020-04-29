<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['client_id', 'booking_type_id', 'description', 'address_id', 'date', 'start_time'];
}
