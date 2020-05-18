<?php

namespace App\Http\Controllers\Auth;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Staff_Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
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
        $staff = Staff::query()->find($id);
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
        $staff = Staff::query()->find($id);
        return view('Administration.staff.staff_delete', ['staff' => $staff]);
    }

    public function postDelete($id) {
        $staff = Staff::query()->find($id);
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

        //TODO: Delete this block
        //Unassign bookings for testing
        $bookings = Booking::all();
        foreach ($bookings as $booking){
            $booking->status = 'available';
            $booking->staff_needed = $booking->available_slots;

            $booking->save();
        }
        $staff_assignments = Staff_Assignment::all();
        foreach($staff_assignments as $sa){
            $sa->delete();
        }
        //

        if(Auth::guard('staff')->attempt($credentials)){
            $currentStaff = Staff::query()->where('email', $request->input('email'))->firstOrFail();
            $request->session()->put('user', $currentStaff);
            $date = today();
            $request->session()->put('date1', $date);

            $d = Carbon::parse(today())->dayOfWeek;
            $startOfWeek = today()->addDays(-$d);
            $endOfWeek = today()->addDays((6-$d));
            $request->session()->put('weekStart', $startOfWeek);
            $request->session()->put('weekEnd', $endOfWeek);
            $request->session()->put('type', 'staff');
            //load data and show profile page
            return redirect()->route('security.index');
        }
        return redirect()->back()->with('error','Email Address or Password not recognised');
    }


    public function logout() {
        Auth::logout();
        Session::flush();
        if(!(Auth::check() || (Session::has('user')))){
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Logout failed');
    }



}
