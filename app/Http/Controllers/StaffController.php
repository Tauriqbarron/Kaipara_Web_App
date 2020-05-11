<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Staff;
use App\Staff_Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{

    public function getHome() {
        $currentStaff = Staff::query()->find(1);
        $bookings = app('App\Http\Controllers\BookingsController')->getStaffBookings($currentStaff);
        $availableBookings = Booking::query()->where('status', "=", 'available')
            ->orderBy('date','asc')
            ->orderBy('start_time', 'asc')
            ->get();
        return view('Security.index', ['staff' => $currentStaff, 'bookings'=> $bookings, 'availableBookings'=>$availableBookings]);
    }
    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email|unique:staff',
            'pNumber'=>'required|max:20',
            'password' => 'required|confirmed|min:6'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $staff = new Staff([
            'first_name' => $request->input('fName'),
            'last_name' => $request->input('lName'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('pNumber'),
            'password' => Hash::make($request->input('password')),
        ]);
        $staff->save();
        return redirect()->route('staff.index');
    }

    public function  getEdit($id) {
        $staff = Staff::find($id);
        return view('Administration.staff.staff_edit', ['staff' => $staff]);

    }
    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email',
            'pNumber'=>'required|max:10',
        ]);
        if($validator->fails()) {
            return redirect()->route('staff.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $staff = Staff::find($id);
        $staff->first_name = $request->input('fName');
        $staff->last_name = $request->input('lName');
        $staff->email = $request->input('email');
        $staff->phone_number = $request->input('pNumber');
        $staff->save();
        return redirect()->route('staff.index');
    }

    public function getDelete($id) {
        $staff = Staff::find($id);
        return view('Administration.staff.staff_delete', ['staff' => $staff]);
    }

    public function postDelete($id) {
        $staff = Staff::find($id);
        $staff->delete();
        return redirect()->route('staff.index');
    }

    /*login Part*/
    public function getLoginForm() {
        return view('login.securitylogin');
    }

    /*Currently not finish*/
    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if(Auth::guard('staff')->attempt($credentials)){
            $currentStaff = Staff::query()->where('email', $request->input('email'))->firstOrFail();
            $bookings = app('App\Http\Controllers\BookingsController')->getStaffBookings($currentStaff)
                ->orderBy('date','asc')
                ->orderBy('start_time', 'asc')
                ->get();
            $availableBookings = Booking::query()->where('status', "=", 'available')
                ->orderBy('date','asc')
                ->orderBy('start_time', 'asc')
                ->get();
            return view('Security.index', ['staff' => $currentStaff, 'bookings'=> $bookings, 'availableBookings'=>$availableBookings]);
        }
        else error_log('Login unsuccessful');
        return redirect()->back();
    }

    public function acceptBooking($staff_id, $booking_id){
        $assignment = new Staff_Assignment([
            'staff_id' => $staff_id,
            'booking_id' => $booking_id
        ]);
        $assignment->save();

        $booking = Booking::query()->find($booking_id);
        $booking->status = 'assigned';
        $booking->save();

        return redirect()->route('security.index');
    }

    public function logout() {
        Auth::guard('staff')->logout();
        return redirect('/');
    }

}
