<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable;
class Staff extends Model implements Auth
{
    use Authenticatable;
    protected $guard = 'staff';
    protected $primaryKey = 'id';
    protected  $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'imgPath', 'street', 'suburb', 'city', 'postcode'];
    protected $hidden = ['password'];

    public function staff_Assignments() {
        return $this->hasMany('App\Staff_Assignment');
    }

    public function rosters() {
        return $this->hasMany('App\Roster');
    }
}
