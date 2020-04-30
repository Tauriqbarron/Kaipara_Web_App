<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $fillable = ['address_id','price', 'date', 'client_id','job_type_id'];
}
