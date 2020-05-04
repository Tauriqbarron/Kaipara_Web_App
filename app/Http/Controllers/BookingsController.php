<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Staff_Assignment;
use App\Assignment;
use App\Booking;

class BookingsController extends Controller
{
    public function getStaffBookings(Staff $staff){
        $staffId = $staff->id;
        return Booking::query()->select('*')->whereIn('id',
            Assignment::query()->select('booking_id')->whereIn('id',
                Staff_Assignment::query()->select('assignment_id')->where('staff_id', '=', $staffId)->get() )->get())->get();
    }
}
