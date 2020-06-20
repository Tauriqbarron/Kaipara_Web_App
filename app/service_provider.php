<?php

namespace App;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SpResetPasswordNotification;

class service_provider extends Authenticatable
{
    use Notifiable;
    protected $guard = 'service_provider';
    protected $fillable = ['firstname','lastname','username','email','password','phone_number','street', 'suburb', 'city', 'postcode', 'imgPath'];
    public $timestamps = false;
    protected $hidden = ['password', 'remember_token'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SpResetPasswordNotification($token));
    }

    public function service_provider_jobs() {
        return $this->hasMany('App\service_provider_job');
    }

    public function client_service_feedback(){
        $this->hasMany('App\Client_Service_Feedback');
    }

    public function service_feedback(){
        $this->hasMany('App\Service_Feedback');
    }
}
