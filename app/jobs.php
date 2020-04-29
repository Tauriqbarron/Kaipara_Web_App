<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobs extends Model
{
    protected $fillable = ['SPID','title','imagePath','description','price'];
}
