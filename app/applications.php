<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class applications extends Model
{
    protected $fillable = ['client_id','title','imagePath','description','price','street', 'suburb', 'city', 'postcode'];
}
