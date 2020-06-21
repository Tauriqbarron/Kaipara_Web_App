<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Staff;
use App\Staff_Assignment;
use App\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TimesheetController extends Controller
{
    function start(Request $request){
        $user = Staff::query()->find(Auth::guard('staff')->user()->id);
        $userId = $user->id;
        $validator = Validator::make($request->all(), [
           'staff_assignment_id' => 'required|numeric|exists:App\Staff_Assignment,id'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors(['Something went wrong, please try again']);
        }
        $staff_assignment = Staff_Assignment::query()->find($request->input('staff_assignment_id'));
        if($staff_assignment->staff_id == $userId){
            $timeSheet = new Timesheet([
                'date' => today("NZ"),
                'start_time' => now("NZ")->hour+(now("NZ")->minute*0.01),
                'staff__assignment_id' => $staff_assignment->id,
                'staff_id' => $userId,
                'client_id' => $staff_assignment->booking->client->id,
                'status' => 1
            ]);
            $timeSheet->save();
            $user->current_timesheet_id = $timeSheet->id;
            $user->save();
        }
        else{
            return redirect()->route('security.index')->with('error', 'Something went wrong, please try again');
        }


        return redirect()->route('security.index')->with('message','Job started');


    }

    function stop(Request $request){
        $validator = Validator::make($request->all(), [
            'timesheet_id' => 'required|numeric|exists:App\Timesheet,id'
        ]);
        if($validator->fails()){
            return redirect()->route('security.index')->with('error', 'Something went wrong, please try again');
        }
        else{
            $timesheet = Timesheet::query()->find($request->input('timesheet_id'));
            if(isset($timesheet->stop_time)){
                return redirect()->route('security.index')->with('error', 'Something went wrong, please try again');
            }
            $timesheet->stop_time = now("NZ")->hour+(now("NZ")->minute*0.01);
            $timesheet->status = 2;
            $booking = Booking::query()->find($timesheet->staff_assignment->booking_id);
            if(today('NZ') == Carbon::parse($booking->end_date)){
                $booking->status = 'complete';
            }
            $user = Staff::query()->find(Auth::guard('staff')->user()->id);
            $user->current_timesheet_id = null;
            $user->save();
            $timesheet->save();
            return redirect()->route('security.index')->with('message', 'Job Stopped');
        }
    }
}
