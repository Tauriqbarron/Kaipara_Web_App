<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['message', 'rating', 'service_provider_job_id'];

    public function service_provider_job() {
        return $this->belongsTo('App\Service_Provider_Job', 'service_provider_job_id', 'id');
    }
}
