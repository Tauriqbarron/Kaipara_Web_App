<?php

namespace App;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\StaffResetPasswordNotification;

class Staff extends Authenticatable
{
    use Notifiable;
    protected $guard = 'staff';
    protected $primaryKey = 'id';
    protected  $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'imgPath', 'street', 'suburb', 'city', 'postcode', 'current_timesheet_id'];
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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StaffResetPasswordNotification($token));
    }

    public function feedback(){
        return $this->hasMany('App\Feedback');
    }
    public function client_feedback(){
        return $this->hasMany('App\Client_Feedback');
    }


}
