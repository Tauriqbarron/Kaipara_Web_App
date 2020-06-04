<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //TODO: add feedback to timesheet?
    protected $fillable = ['date','start_time', 'stop_time', 'staff_assignment_id'];

    public function staff_assignment() {
        return $this->belongsTo('App\staff_assignment', 'staff_assignment_id', 'id');
    }
}
