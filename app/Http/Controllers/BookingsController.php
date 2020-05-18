<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Staff_Assignment;
use App\Booking;
use Illuminate\Support\Facades\Session;

class BookingsController extends Controller
{
    public function index(){

    }
    public function getStaffBookings(Staff $staff){
        $staffId = $staff->id;
        return Booking::query()->select('*')->whereIn('id',
                Staff_Assignment::query()->select('booking_id')->where('staff_id', '=', $staffId)->get())
            ->whereDate('date','=', Session::get('date1'))
            ->orderBy('date','asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function getTimetable(Staff $staff){
        $staffId = $staff->id;
        return Booking::query()->select('*')->whereIn('id',
            Staff_Assignment::query()->select('booking_id')->where('staff_id', '=', $staffId)->get())
            ->whereBetween('date', array(Session::get('weekStart'), Session::get('weekEnd')))
            ->orderBy('date','asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function getCreate(){

        return view('Security.booking.create');
    }
}
