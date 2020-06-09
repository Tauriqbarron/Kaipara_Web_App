<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable;

class service_provider extends Model implements Auth
{
    use Authenticatable;
    protected $guard = 'service_provider';
    protected $fillable = ['firstname','lastname','username','email','password','phone_number','street', 'suburb', 'city', 'postcode'];
    public $timestamps = false;

    public function service_provider_jobs() {
        return $this->hasMany('App\service_provider_job');
    }
}
