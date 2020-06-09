<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave_Request extends Model
{
    protected $table = 'leave_requests';
    protected $fillable = ['staff_id','subject', 'message', 'absence_types_id', 'start_date', 'end_date', 'absence_status_id', 'updated_on'];
    public $timestamps = false;

    public function absence_status()
    {
        return $this->hasOne('App\Absence_Status', 'absence_status_id', 'id');
    }
    public function absence_types()
    {
        return $this->hasOne('App\Absence_Types', 'absence_types_id', 'id');
    }
}
