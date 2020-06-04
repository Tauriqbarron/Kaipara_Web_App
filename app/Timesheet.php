<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //TODO: add feedback to timesheet?
    protected $fillable = ['date','start_time', 'stop_time', 'staff__assignment_id'];

    public function staff_assignment() {
        return $this->belongsTo('App\staff_assignment', 'staff__assignment_id', 'id');
    }


}
