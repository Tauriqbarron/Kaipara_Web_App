<?php

namespace App\Http\Controllers;

use App\Staff_Assignment;
use App\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimesheetController extends Controller
{
    function start($staff_assignment_id){
        $user = Session::has('user') ? Session::get('user'): null;
        $userId = $user->id;

        $staff_assignment = Staff_Assignment::query()->find($staff_assignment_id);

        if($staff_assignment->staff_id == $userId){
            $timeSheet = new Timesheet([
                'date' => today(),
                'start_time' => now()->hour+(now()->minute/10),
                'staff_assignment_id' => $staff_assignment_id
            ]);
        }

        Session::put('inProgress',1);

        return redirect()->route('security.index')->with('message','Job started');


    }

    function stop(){

    }
}
