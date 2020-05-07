<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function getHome() {
        $currentStaff = Staff::query()->find(1);
        $bookings = app('App\Http\Controllers\BookingsController')->getStaffBookings($currentStaff);
        $availableBookings = Booking::query()->where('status', "=", 'available')
            ->orderBy('date','asc')
            ->orderBy('start_time', 'asc')
            ->get();
        return view('Security.index', ['staff' => $currentStaff, 'bookings'=> $bookings, 'availableBookings'=>$availableBookings]);
    }

}
