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
        return $this->hasMany('App\applications');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }

    public function  feedback(){
        return $this->hasMany('App\Feedback', 'client_id', 'id');
    }
    public function  client_feedback(){
        return $this->hasMany('App\Client_Feedback', 'client_id', 'id');
    }
    public function  client_service_feedback(){
        return $this->hasMany('App\Client_Service_Feedback', 'client_id', 'id');
    }
    public function  service_feedback(){
        return $this->hasMany('App\Service_Feedback', 'client_id', 'id');
    }

}
