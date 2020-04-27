<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = ['start_time', 'stop_time', 'staff_assignment_id'];
}
