<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_Type extends Model
{
    protected $fillable = ['description'];
    public $timestamps = false;


    public function applications() {
        return $this->hasMany('App\applications');
    }
}
