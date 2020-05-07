<?php

namespace App\Http\Controllers\Auth;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Staff;

class AdminStaffController extends Controller
{
    public function getIndex() {
        $staffs = Staff::all();
        return view('Administration.staff.index', ['staffs' => $staffs]);
    }

    public function getSearch(Request $request) {
        $search = $request->input('search');
        $staffs = Staff::where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')
            ->paginate(5);
        $staffs->appends(['search' => $search]);
        return view('Administration.staff.index', ['staffs' => $staffs]);
    }

    public function getCreate() {
        return view('Administration.staff.staff_create');
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email|unique:staff',
            'pNumber'=>'required|max:20',
            'password' => 'required|confirmed|min:6',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            //'country'=>'required',
            'postcode'=>'required'
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
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode')
        ]);
        $staff->save();
        return redirect()->route('staff.index');
    }

    public function viewStaff($id) {
        $staff = Staff::find($id);
        return view('Administration.staff.staff_view', ['staff' => $staff]);
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
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            //'country'=>'required',
            'postcode'=>'required'
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
        $staff->street = $request->input('street');
        $staff->suburb = $request->input('suburb');
        $staff->city = $request->input('city');
        //$staff->country = $request->input('country');
        $staff->postcode = $request->input('postcode');
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
            $staff = Staff::where('email', $request->input('email'))->firstOrFail();
            $bookings = Booking::all();
            $addresses = Address::all();
            $infore = [$staff, $bookings, $addresses];
            return view('Security.index', ['staff' => $staff, 'bookings' => $bookings, 'addresses' => $addresses]);
        }
        return redirect()->back();
    }

    public function logout() {
        Auth::guard('staff')->logout();
        return redirect('/');
    }
}
