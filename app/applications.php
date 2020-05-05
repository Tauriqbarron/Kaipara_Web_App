<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class applications extends Model
{
    protected $fillable = ['title','imagePath','description','price','street', 'suburb', 'city', 'postcode'];
}
