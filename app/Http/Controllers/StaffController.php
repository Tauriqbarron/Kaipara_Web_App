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
            return redirect('/');
        }
    }

    public function acceptBooking($booking_id){

        $user = Session::has('user') ? Session::get('user'): null;
        $staff_id = $user->id;
        $assignment = new Staff_Assignment([
            'staff_id' => $staff_id,
            'booking_id' => $booking_id
        ]);
        $assignment->save();

        $booking = Booking::query()->find($booking_id);
        $booking->status = 'assigned';
        $booking->save();

        return redirect()->route('security.index');
    }

}
