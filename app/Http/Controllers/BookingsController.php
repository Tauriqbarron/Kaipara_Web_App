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

    public function getCreate(){

        return view('Security.booking.create');
    }
}
