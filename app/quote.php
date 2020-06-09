<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quote extends Model
{
    protected $fillable = ['service_provider_id','job_id','price','message', 'quote_type', 'estimate_hours'];
    public $timestamps = false;
}
