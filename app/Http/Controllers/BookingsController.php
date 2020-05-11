<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Staff_Assignment;
use App\Booking;

class BookingsController extends Controller
{
    public function index(){

    }
    public function getStaffBookings(Staff $staff){
        $staffId = $staff->id;
        return Booking::query()->select('*')->whereIn('id',
                Staff_Assignment::query()->select('booking_id')->where('staff_id', '=', $staffId)->get())
            ->orderBy('date','asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }
}
