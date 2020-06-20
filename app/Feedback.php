<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['message', 'rating', 'staff__assignment_id', 'staff_id', 'client_id'];

    public function staff_assignment() {
        return $this->belongsTo('App\Staff_Assignment', 'staff__assignment_id', 'id');
    }
}
