<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable;
class Staff extends Model implements Auth
{
    use Authenticatable;
    protected $guard = 'staff';
    protected  $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'imgPath', 'street', 'suburb', 'city', 'postcode'];

    public function staff_Assignment() {
        return $this->hasMany('App\Staff_Assignment');
    }

    public function rosters() {
        return $this->hasMany('App\Roster');
    }
}
