<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable;

class Clients extends Model implements Auth
{
    use Authenticatable;
    protected $guard = 'clients';
    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'street', 'suburb', 'city', 'postcode'];

    public function bookings() {
        return $this->hasMany('App\Booking');
    }

    public function applications() {
        return $this->hasMany('App\application');
    }

}
