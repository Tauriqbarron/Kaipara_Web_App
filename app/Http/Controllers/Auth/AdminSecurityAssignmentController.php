<?php

namespace App\Http\Controllers\Auth;


use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Staff_Assignment;
use App\Booking_Types;
use App\Clients;
use App\Staff;
use Illuminate\Support\Facades\DB;

class AdminSecurityAssignmentController extends Controller
{
    public function getIndex() {
        $assignments = Staff_Assignment::all();
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }

    public function Search(Request $request) {
        $search = $request->input('search');
        $assignments = Staff_Assignment::where('booking_id', 'like', '%'.$search.'%')
            ->paginate(5);
        $assignments->appends(['search' => $search]);
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }

    public function view($id) {
        $assignment = Staff_Assignment::find($id);
        return view('Administration.security_Assignment.sec_view', ['assignment' => $assignment]);
    }

    public function getCreate(){
        $types = Booking_Types::all();
        $staffs = Staff::all();
        return view('Administration.security_Assignment.sec_create', ['types' => $types, 'staffs' => $staffs]);
    }



}
