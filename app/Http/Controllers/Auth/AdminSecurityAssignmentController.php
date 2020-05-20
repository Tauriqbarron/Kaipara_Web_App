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
            'date' => 'required|date|date_format:Y-m-d|after:today',
            'street' => 'required',
            'suburb' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'numOfStaff' => 'required'
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
            'status' => 'available',
            'staff_needed' => $request->input('numOfStaff'),
            'available_slots' => $request->input('numOfStaff'),
            'start_time' => '8.30',
            'finish_time' => '16.30',
        ]);

        $booking->save();
        return redirect()->route('security_assignment.index');

    }

    /*Direct to the assign a staff to the assignment page*/
    public function getAssign(Request $request, $id) {
        $assignment = Booking::find($id);
        if($assignment->available_slots != 0){
            $staffs = Staff::all();
            return view('Administration.security_Assignment.assign_staff', ['assignment' => $assignment, 'staffs' => $staffs]);
        }else{
            return redirect()->route('security_assignment.index')->with('message', 'Successful');
        }

    }

    /*Assign a staff to the assignment*/
    public function postAssign(Request $request, $id) {
        $booking = Booking::find($id);
        $record = Staff_Assignment::where('staff_id', '=', $request->input('staff'))
            ->where('booking_id', '=', $id)
            ->first();
        if($record == null){
            $staff_assignment = new Staff_Assignment([
                'staff_id' => $request->input('staff'),
                'booking_id' => $id
            ]);
            $staff_assignment->save();
            $booking->available_slots = $booking->available_slots - 1;
            if($booking->available_slots == 0) {
                $booking->status = 'assigned';
            }
            $booking->save();
            return redirect()->route('security_assignment.index');
        }
        else{
            return redirect()->back()->withErrors('The staff has already been assign to this assignment.');
        }
    }

    public function getEdit($id) {
        $assignment = Booking::find($id);
        $types = Booking_Types::all();
        return view('Administration.security_Assignment.sec_edit', ['assignment' => $assignment, 'types' => $types]);
    }

    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'booking_type' => 'required',
            'description' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
            'start_time' => 'required',
            'finish_time' => 'required',
            'numOfStaff' => 'required',
            'street' => 'required',
            'suburb' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $assignment = Booking::find($id);
        $assignment->booking_type_id = $request->input('booking_type');
        $assignment->description = $request->input('description');
        $assignment->date = $request->input('date');
        $assignment->start_time = $request->input('start_time');
        $assignment->finish_time = $request->input('finish_time');
        $assignment->staff_needed = $request->input('numOfStaff');
        $assignment->available_slots = $request->input('numOfStaff');
        $assignment->street = $request->input('street');
        $assignment->suburb = $request->input('suburb');
        $assignment->city = $request->input('city');
        $assignment->postcode = $request->input('postcode');
        $assignment->status = $request->input('status');
        $assignment->save();
        return redirect()->route('security_assignment.index');
    }

    public function getChangeStaff($id) {
        $staff_assignment = Staff_Assignment::find($id);
        $staffs = Staff::all();
        return view('Administration.security_Assignment.change_staff', ['staff_assignment' => $staff_assignment, 'staffs' => $staffs]);
    }

    public function postChangeStaff(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'staff' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $staff_assignment = Staff_Assignment::find($id);
        $record = Staff_Assignment::where('staff_id', '=', $request->input('staff'))
            ->where('booking_id', '=', $staff_assignment->booking_id)
            ->first();
        if($record == null) {
            $staff_assignment->staff_id = $request->input('staff');
            $staff_assignment->save();
            return redirect()->route('security_assignment.edit', ['id' => $staff_assignment->booking_id]);
        }
        else {
            return redirect()->back()->withErrors('The staff has already been assign to this assignment.');
        }

    }



}
