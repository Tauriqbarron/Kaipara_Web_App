<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
class StaffController extends Controller
{
    public function getIndex(){
        $staffs = Staff::all();
        return view('Administration.staff_management', ['staffs' => $staffs]);
    }
}
