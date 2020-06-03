<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Provider_Job extends Model
{
    protected $fillable = ['service_provider_id', 'job_id'];

    public function feedback() {
        return $this->hasMany('App\Feedback');
    }
}
