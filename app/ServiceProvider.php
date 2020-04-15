<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = ['firstname','lastname','username','email','password','phone_number'];
    public $timestamps = false;
}
