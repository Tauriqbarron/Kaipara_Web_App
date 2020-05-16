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
use Illuminate\Support\Facades\Validator;

class AdminSecurityAssignmentController extends Controller
{

    /*public function getIndex() {
        $assignments = Staff_Assignment::all();
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }*/

    public function getIndex() {
        $assignments = Booking::all();
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }

    public function Search(Request $request) {
        $search = $request->input('search');
        $assignments = Booking::where('booking_id', 'like', '%'.$search.'%')
            ->paginate(5);
        $assignments->appends(['search' => $search]);
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }

    public function view($id) {
        $assignment = Booking::find($id);
        return view('Administration.security_Assignment.sec_view', ['assignment' => $assignment]);
    }

    public function getCreate(){
        $types = Booking_Types::all();
        $staffs = Staff::all();
        return view('Administration.security_Assignment.sec_create', ['types' => $types, 'staffs' => $staffs]);
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'booking_type' => 'required',
            'description' => 'required',
            'date' => 'required|date|date_format:d-m-Y|after:today',
            'street' => 'required',
            'suburb' => 'required',
            'city' => 'required',
            'postcode' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $client = Clients::where('id', '=', $request->input('client_id'));
        if($client == null) {
            return redirect()->back()->withErrors('The client does not exist.');
        }

        $booking = new Booking([
            'client_id' => $request->input('client_id'),
            'booking_type_id' => $request->input('booking_type'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode'),
            'status' => 'available'
        ]);

        $booking->save();
        return redirect()->route('security_assignment.index');


    }



}
