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

    /*Get index function*/
    public function getIndex() {
        $assignments = Booking::paginate(10);
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }

    /*Search assignment function*/
    public function Search(Request $request) {
        $search = $request->input('search');
        $assignments = Booking::where('id', 'like', '%'.$search.'%')
            ->orWhere('client_id', 'like', '%'.$search.'%')
            ->paginate(5);
        $assignments->appends(['search' => $search]);
        return view('Administration.security_Assignment.index', ['assignments' => $assignments]);
    }


    /*View an assignment*/
    public function view($id) {
        $assignment = Booking::find($id);
        return view('Administration.security_Assignment.sec_view', ['assignment' => $assignment]);
    }


    /*Create an new assignment*/
    public function getCreate(){
        $types = Booking_Types::all();
        $staffs = Staff::all();
        return view('Administration.security_Assignment.sec_create', ['types' => $types, 'staffs' => $staffs]);
    }

    public function postCreate(Request $request) {

        $validator = Validator::make($request->all(), [
            'client_id' => 'required|numeric',
            'booking_type' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'date' => 'required|date|date_format:Y-m-d|after:today',
            'end_date' => 'required|date|date_format:Y-m-d|after:today',
            'street'=>'required|regex:/^[A-Za-z0-9\s?\-?\.?]+$/',
            'suburb'=>'required|regex:/^[A-Za-z\s?]+$/',
            'city'=>'required|regex:/^[A-Za-z\s?]+$/',
            'postcode'=>'required|digits:4',
            'numOfStaff' => 'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if(!Clients::where('id', '=', $request->input('client_id'))->exists()) {
            return redirect()->back()->with('message', 'The client does not exist.')->withInput($request->all());
        }

        $booking = new Booking([
            'client_id' => $request->input('client_id'),
            'booking_type_id' => $request->input('booking_type'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'end_date' => $request->input('end_date'),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode'),
            'status' => 'available',
            'staff_needed' => $request->input('numOfStaff'),
            'available_slots' => $request->input('numOfStaff'),
        ]);
        if ($request->input('start_time') != null) {
            $booking->start_time = $request->input('start_time');
        }else{
            $booking->start_time = '9.30';
        }
        if ($request->input('end_time') != null) {
            $booking->finish_time = $request->input('finish_time');
        }else{
            $booking->finish_time = '16.30';
        }

        $booking->save();
        return redirect()->route('security_assignment.index')->with('message', 'New security assignment created.');

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

    /*Edit an assignment*/
    public function getEdit($id) {
        $assignment = Booking::find($id);
        $types = Booking_Types::all();
        return view('Administration.security_Assignment.sec_edit', ['assignment' => $assignment, 'types' => $types]);
    }

    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'booking_type' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:today',
            'start_time' => 'required',
            'finish_time' => 'required',
            'numOfStaff' => 'required',
            'street'=>'required|regex:/^[A-Za-z0-9\s?]+$/',
            'suburb'=>'required|regex:/^[A-Za-z\s?]+$/',
            'city'=>'required|regex:/^[A-Za-z\s?]+$/',
            'postcode'=>'required|digits:4',
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
        $assignment->price = $request->input('price');
        $assignment->date = $request->input('date');
        $assignment->end_date = $request->input('end_date');
        $assignment->start_time = $request->input('start_time');
        $assignment->finish_time = $request->input('finish_time');
        $assignment->street = $request->input('street');
        $assignment->suburb = $request->input('suburb');
        $assignment->city = $request->input('city');
        $assignment->postcode = $request->input('postcode');
        $assignment->status = $request->input('status');

        /*Check if the number of security officer is changed or not.*/
        if($request->input('numOfStaff') - $assignment->staff_needed > 0) {
            /*if require more security officers*/
            $assignment->staff_needed = $request->input('numOfStaff');
            $assignment->available_slots = $assignment->available_slots + ($request->input('numOfStaff') - $assignment->staff_needed);
            $assignment->status = 'available';
            $assignment->save();
        }elseif ($request->input('numOfStaff') - $assignment->staff_needed < 0) {
            /*if required less security officers.*/
            $assignment->staff_needed = $request->input('numOfStaff');
            $assignment->available_slots = $request->input('numOfStaff');
            $assignment->status = 'available';
            $staff_assignments = Staff_Assignment::where('booking_id', '=', $id)->get();
            if($staff_assignments != null) {
                foreach ($staff_assignments as $record) {
                    $record->delete();
                }
            }
            $assignment->save();
        }else {
            /*if the number of security officer is not changed.*/
            $assignment->save();
        }

        return redirect()->route('security_assignment.index')->with('message', 'Update successfully.');
    }



    /*change the assigned staff for an assignment*/
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
            return redirect()->back()->withErrors('The staff has already been assigned to this assignment.');
        }

    }


    /*Delete an security assignment record*/
    public function getDelete($id) {
        $assignment = Booking::find($id);
        return view('Administration.security_Assignment.sec_delete', ['assignment' => $assignment]);
    }

    public function postDelete($id) {
        $assignment = Booking::find($id);
        $staff_assignments = Staff_Assignment::where('booking_id', '=', $id)->get();
        if($staff_assignments == null) {
            $assignment->delete();
            return redirect()->route('security_assignment.index');
        }
        else{
            return redirect()->back()->withErrors('You can not delete a processing assignment.');
        }

    }



}
