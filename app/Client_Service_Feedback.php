<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_Service_Feedback extends Model
{
    protected $fillable = ['rating', 'message', 'service__provider__job_id', 'status','service__provider_id', 'client_id'];

    public function service_provider_job(){
        return $this->belongsTo('App\Service_Provider_Job', 'service__provider__job_id', 'id');
    }
    public function service_provider(){
        return $this->belongsTo('App\service_provider', 'service__provider_id', 'id');
    }
    public function client(){
        return $this->belongsTo('App\Clients', 'client_id', 'id');
    }
}
