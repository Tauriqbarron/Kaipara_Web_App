<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class applications extends Model
{
    protected $fillable = ['client_id','title','imagePath','description','price','street', 'suburb', 'city', 'postcode', 'date', 'end_date','job__type_id', 'status'];

    public $timestamps = false;

    public function client() {

        return $this->belongsTo('App\Clients', 'client_id', 'id');
    }

    public function service_provider_job() {
        return $this->hasOne('app\Service_Provider_job', 'job_id', 'id');
    }

    public function quotes() {
        return $this->hasMany('App\quote', 'job_id', 'id');
    }

    public function job_type() {
        return $this->belongsTo('App\Job_Type', 'job__type_id', 'id');
    }


}
