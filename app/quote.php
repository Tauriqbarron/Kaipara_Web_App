<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quote extends Model
{
    protected $fillable = ['service_provider_id','job_id','price','message', 'quote_type', 'estimate_hours'];
    public $timestamps = false;

    public function application() {
        return $this->belongsTo('App\applications', 'job_id', 'id');
    }
    public function service_provider(){
        return $this->belongsTo('App\service_provider', 'service_provider_id', 'id');
    }
}
