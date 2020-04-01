<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected  $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password'];
}
