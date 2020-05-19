<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quote extends Model
{
    protected $fillable = ['service_provider_id','job_id','price','message'];
    public $timestamps = false;
}
