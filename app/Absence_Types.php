<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence_Types extends Model
{
    protected $table = 'absence_types';
    protected $fillable = ['description'];
    public $timestamps = false;

    public function leave_request()
    {
        $this->hasMany('App\Leave_Request');
    }
}
