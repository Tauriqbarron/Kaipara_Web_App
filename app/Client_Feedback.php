<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_Feedback extends Model
{
    protected $fillable = ['rating', 'message', 'staff__assignment_id','staff_id', 'client_id'];

    public $timestamps = false;

    public function staff_assignment(){
        return $this->belongsTo('App\Staff_Assignment', 'staff__assignment_id', 'id');
    }
    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
    public function client(){
        return $this->belongsTo('App\Clients', 'client_id', 'id');
    }
}
