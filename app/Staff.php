<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable;
class Staff extends Model implements Auth
{
    use Authenticatable;
    protected $guard = 'staff';
    protected  $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'street', 'suburb', 'city', 'postcode'];
}
