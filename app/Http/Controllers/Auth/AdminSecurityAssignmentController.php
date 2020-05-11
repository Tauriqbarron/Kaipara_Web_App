<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Staff_Assignment;
use App\Booking_Types;
use App\Clients;
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



}
