<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Staff;
use App\Staff_Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class StaffController extends Controller
{

    public function getHome() {
        $user = Session::has('user') ? Session::get('user'): null;
        if($user != null) {
            $currentStaff = Staff::query()->find($user->id);
            $bookings = app('App\Http\Controllers\BookingsController')->getStaffBookings($currentStaff);
            $availableBookings = Booking::query()->where('status', "=", 'available')
                ->orderBy('date', 'asc')
                ->orderBy('start_time', 'asc')
                ->get();

            return view('Security.index', ['staff' => $currentStaff, 'bookings' => $bookings, 'availableBookings' => $availableBookings]);
        }
        else {
            return redirect()->route('staff.login')->with('error', 'You must log in to view your profile');
        }
    }

    public function acceptBooking($booking_id) {
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
            $theBookingStartTime = strtotime($theBooking->start_time);
            $bookingStartTime = strtotime($booking->start_time);
            //TODO replace with actual finish times
            $theBookingFinishTime = strtotime(strftime("%H:%M", $theBookingStartTime + 5*60*60));
            $bookingFinishTime = strtotime(strftime("%H:%M", $bookingStartTime + 5*60*60));
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

            $booking->status = 'assigned';
            $booking->save();
        }

        return redirect()->route('security.index');
    }


}
