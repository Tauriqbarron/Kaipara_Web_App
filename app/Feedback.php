<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['message', 'rating', 'timesheet_id'];

    public function timesheet(){
        $this->belongsTo('App\Timesheet', 'timesheet_id', 'id');
    }
}
