<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Staff;
use App\Staff_Assignment;
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

            $currentStaff = Staff::query()->find(Auth::guard('staff')->user()->id);
            $bookings = app('App\Http\Controllers\BookingsController')->getStaffBookings($currentStaff);
            $timetable = app('App\Http\Controllers\BookingsController')->getTimetable($currentStaff);
            $availableBookings = Booking::query()->select('*')->whereNotIn('id',
                Staff_Assignment::query()->select('booking_id')->where('staff_id', '=', $currentStaff->id)->get())
                ->whereDate('date', '>=', today())
                ->orderBy('date','asc')
                ->orderBy('start_time', 'asc')
                ->get();

            return view('Security.index', ['staff' => $currentStaff, 'bookings' => $bookings, 'availableBookings' => $availableBookings, 'timetable' => $timetable]);
        }
        else {
            return redirect()->route('staff.login')->with('error', 'You must log in to view your profile');
        }
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
        $staff_assignments = $staff->staff_Assignment;
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

}
