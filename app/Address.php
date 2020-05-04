<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['street', 'suburb', 'city', 'country', 'postcode'];

    public function client() {
        $this->hasMany('App\Clients');
    }
}
