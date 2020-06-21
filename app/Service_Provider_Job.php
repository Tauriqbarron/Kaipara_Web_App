<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Provider_Job extends Model
{
    protected $fillable = ['service_provider_id', 'job_id'];

    public function application() {
        return $this->belongsTo('App\applications', 'job_id', 'id');
    }

    public function service_provider() {
        return $this->belongsTo('App\service_provider', 'service_provider_id', 'id');
    }
    public function client_service_feedback(){
        return $this->hasMany('App\Client_Service_Feedback');
    }
    public function service_feedback(){
        return $this->hasMany('App\Service_Feedback');
    }

}
