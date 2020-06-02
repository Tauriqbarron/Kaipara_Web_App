<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Staff_Assignment;
use App\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimesheetController extends Controller
{
    /*TODO: Rules:
        Define criteria around starting and finishing a job
            - When is it too early to start
            - When is it too late to start
            - When is it too early to finish
            - When is it too late to finish:
                -- Should there be a cut off time where a job finishes automatically
            - Should the job automatically finish if the user gets too far away from the job location
            - Should the job only start if the user is in proximity of the job location
            - Should a time sheet allow for multiple stops/starts and record all of them
    */
    function start(Request $request){
        $user = Session::has('user') ? Session::get('user'): null;
        $userId = $user->id;
        $bookingId = $request->get('bookingId');
        $staff_assignment = Staff_Assignment::query()->select()->where('staff_id', '=', $userId)->where('booking_id', '=', $bookingId)->firstOrFail();


        if($staff_assignment->staff_id == $userId){
            $timeSheet = new Timesheet([
                'date' => today("NZ"),
                'start_time' => now("NZ")->hour+(now("NZ")->minute*0.01),
                'staff_assignment_id' => $staff_assignment->id
            ]);
            $timeSheet->save();
            Session::put('inProgress', $timeSheet);
        }
        else{
            return redirect()->route('security.index')->with('error', 'Something went wrong, please try again');
        }


        return redirect()->route('security.index')->with('message','Job started');


    }

    function stop(){
        if(!Session::has('inProgress')){
            return redirect()->route('security.index')->with('error', 'Something went wrong, please try again');
        }
        else{
            $timesheet = Session::pull('inProgress');

            $timesheet->stop_time = now("NZ")->hour+(now("NZ")->minute*0.01);
            $timesheet->save();

            return redirect()->route('security.index')->with('message', 'Job Stopped');
        }

    }

    function getStaffTimeSheets(){

    }
}
