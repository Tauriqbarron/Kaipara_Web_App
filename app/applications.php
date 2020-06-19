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
<<<<<<< HEAD
        return $this->hasOne('App\Service_Provider_Job', 'job_id', 'id');
=======
        return $this->hasOne('\App\Service_Provider_job', 'job_id', 'id');
>>>>>>> dbdb78d13d714ad30677a3b1a9fa64916a3ca026
    }

    public function quotes() {
        return $this->hasMany('App\quote', 'job_id', 'id');
    }

    public function job_type() {
        return $this->belongsTo('App\Job_Type', 'job__type_id', 'id');
    }


}
