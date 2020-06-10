<?php

namespace App;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
class Staff extends Model implements Auth
{
    use Authenticatable;
    use Notifiable;
    protected $guard = 'staff';
    protected $primaryKey = 'id';
    protected  $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'imgPath', 'street', 'suburb', 'city', 'postcode'];
    protected $hidden = ['password'];
    protected $dispatchesEvents = [
        'created' => Events\CreateStaff::class
    ];

    public function staff_Assignments() {
        return $this->hasMany('App\Staff_Assignment');
    }

    public function rosters() {
        return $this->hasMany('App\Roster');
    }
    public function leave_requests() {
    return $this->hasMany('App\Leave_Request');
    }
}
