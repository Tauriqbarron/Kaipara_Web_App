<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = ['date','start_time', 'stop_time', 'staff__assignment_id','status'];

    public function staff_assignment() {
        return $this->belongsTo('App\Staff_Assignment', 'staff__assignment_id', 'id');
    }


}
