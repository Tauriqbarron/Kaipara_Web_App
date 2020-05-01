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
        error_log($staffId);
        error_log('staff '.$staff->id);
        $staffAssignments = Staff_Assignment::query()->select('assignment_id')->where('staff_id', '=', $staffId)->get();
        $assignments = Assignment::query()->select('booking_id')->whereIn('id', $staffAssignments )->get();
        $bookings = Booking::query()->select('*')->whereIn('id', $assignments)->get();

        return $bookings;
    }
}
