<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    protected $fillable = ['staff_id', 'date'];

    public function staff() {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
}
