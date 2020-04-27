<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['message', 'rating', 'staff_assignment_id', 'assigned_job_id'];
}
