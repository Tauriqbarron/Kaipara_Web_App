<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Feedback;
use App\Leave_Request;
use App\Staff;
use App\Staff_Assignment;
use App\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class StaffController extends Controller
{

    public function getHome() {

        if(Auth::guard('staff')->check()) {
            //TODO: Only access database when something changes rather than reloading the same data
            $currentStaff = Staff::query()->find(Auth::guard('staff')->user()->id);
            $staff_assignments = $currentStaff->staff_assignments->pluck('booking_id');

            $bookings = Booking::query()->select('*')->whereIn('id', $staff_assignments)
                ->orWhere('available_slots', '>', '0')->get();


            $staff_bookings = $bookings->whereIn('id', $staff_assignments)
                ->where('date','=', Carbon::parse(Session::get('date1'))->format('Y-m-d'))
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $availableBookings = $bookings->whereNotIn('id', $staff_assignments)
                ->where('date', '>=', today("NZ"))
                ->where('available_slots','>','0')
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $completedBookings = $bookings->whereIn('id', $staff_assignments)
                ->where('date', '<=', today("NZ"))
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $timetable = $bookings->whereIn('id', $staff_assignments)
                ->whereBetween('date', array(Session::get('weekStart'), Session::get('weekEnd')))
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            return view('Security.index', ['staff' => $currentStaff, 'bookings' => $staff_bookings,'completedBookings' => $completedBookings, 'availableBookings' => $availableBookings, 'timetable' => $timetable]);
        }
        else {
            return redirect()->route('staff.login')->with('error', 'You must log in to view your profile');
        }
    }

    public function postFeedback(Request $request){

        $feedback = new Feedback([

            'rating' => $request->get('star'),
            'message'=> $request->get('message'),
            'staff__assignment_id'=> $request->get('staff_assignment_id'),
        ]);
        $feedback->save();

        return redirect()->back()->with('message', 'Feedback Sent');
    }

    public function dateChange($i){
        if(!Session::has('date1')){
            return redirect()->route('staff.login')->with('error', 'Session has timed out');
        }
        Session::put('page', 'profile');
        $currentDate = Session::get('date1');
        $currentDate->addDays($i);

        Session::put('date1', $currentDate);

        return redirect()->route('security.index');

    }

    public function setWeek($i){
        if(!Session::has('weekStart')){
            return redirect()->route('staff.login')->with('error', 'Session has timed out');
        }
        $j = $i*7;
        $weekStart = Session::get('weekStart');
        $weekEnd = Session::get('weekEnd');

        $weekStart = $weekStart->addDays($j);
        $weekEnd = $weekEnd->addDays($j);

        Session::put('weekStart', $weekStart);
        Session::put('weekEnd', $weekEnd);

        return redirect()->route('security.index');
    }

    public function acceptBooking($booking_id) {
        if(!Session::has('user')) return redirect()->route('staff.login')->with('error', 'Session has timed out');
        $user = Session::has('user') ? Session::get('user') : null;
        $staff_id = $user->id;
        $staff = Staff::query()->find($staff_id);
        $staff_assignments = $staff->staff_Assignments;
        //TODO: Tidy this up
        $booking = Booking::query()->find($booking_id);

        foreach($staff_assignments as $staff_assignment){

            $theBooking = $staff_assignment->booking;
            $theBookingDate = $theBooking->date;
            $bookingDate = $booking->date;
            $theBookingStartTime = $theBooking->start_time;
            $bookingStartTime = $booking->start_time;
            $theBookingFinishTime = $theBooking->finish_time;
            $bookingFinishTime = $theBooking->finish_time;
            $sameDate = $theBookingDate == $bookingDate;
            $sameStartTime = ($theBookingStartTime >= $bookingStartTime) && ($theBookingStartTime <= $bookingFinishTime);
            $sameFinishTime = ($theBookingFinishTime <= $bookingFinishTime) && ($theBookingFinishTime >= $bookingStartTime);

            if($sameDate && ($sameStartTime || $sameFinishTime)){
                return redirect()->back()->with('error', 'Could not accept booking due to Roster conflict');
            }
        }

        if($booking->status == 'available') {
            $assignment = new Staff_Assignment([
                'staff_id' => $staff_id,
                'booking_id' => $booking_id
            ]);
            $assignment->save();

            $booking->available_slots -= 1;

            if($booking->available_slots == 0){
                $booking->status = 'assigned';
            }
            $booking->save();
        }
        return redirect()->route('security.index');
    }

    public function postLeave(Request $request){

        $leaveRequest = new Leave_Request([
           'subject' => $request->get('subject'),
           'message' => $request->get('message'),
           'absence_types_id' => $request->get('type'),
           'absence_status_id' => 1,
           'start_date' => $request->get('startDate'),
           'end_date' => $request->get('EndDate'),
           'staff_id' => auth()->guard('staff')->user()->id
        ]);
        $leaveRequest->save();
        return redirect()->route('security.index')->with('message', 'Leave Request Sent');

    }

}
