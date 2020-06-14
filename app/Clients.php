<?php

namespace App;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ClientResetPasswordNotification;

class Clients extends Authenticatable
{
    use Notifiable;
    protected $guard = 'client';
    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'street', 'suburb', 'city', 'postcode'];

    public function bookings() {
        return $this->hasMany('App\Booking');
    }

    public function applications() {
        return $this->hasMany('App\application');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }

}
