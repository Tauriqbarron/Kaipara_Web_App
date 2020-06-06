<?php

namespace App\Http\Controllers\Auth;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Roster;
use App\Staff_Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
use App\Staff;
use MaddHatter\LaravelFullcalendar\Calendar;

class AdminStaffController extends Controller
{
    //Get the staff list.
    public function getIndex() {
        $staffs = Staff::all();
        return view('Administration.staff.index', ['staffs' => $staffs]);
    }

    //Search staff function.
    public function getSearch(Request $request) {
        $search = $request->input('search');
        $staffs = Staff::where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')
            ->paginate(5);
        $staffs->appends(['search' => $search]);
        return view('Administration.staff.index', ['staffs' => $staffs]);
    }

    //Get the create staff page.
    public function getCreate() {
        return view('Administration.staff.staff_create');
    }

    //Save the new staff detail to database.
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

    //View a staff
    public function viewStaff($id) {
        $staff = Staff::find($id);
        return view('Administration.staff.staff_view', ['staff' => $staff]);
    }


    //Get the edit staff page.
    public function  getEdit($id) {
        $staff = Staff::find($id);
        return view('Administration.staff.staff_edit', ['staff' => $staff]);
    }

    //Update a staff details.
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

    //Get the delete staff page
    public function getDelete($id) {
        $staff = Staff::query()->find($id);
        return view('Administration.staff.staff_delete', ['staff' => $staff]);
    }

    //Delete the staff record from the database.
    public function postDelete($id) {
        $staff = Staff::query()->find($id);
        $record = Staff_Assignment::where('staff_id', '=', $id)->get();
        if($record != null) {
            return redirect()->back()->withErrors('This staff is currently assigned to a assignment. Operation failed.');
        }else{
            $staff->delete();
        }

        return redirect()->route('staff.index');
    }

    /*Calendar*/
    public function getCalendar($id) {
        $events = Staff_Assignment::where('staff_id', '=', $id)->get();
        $rosters = Roster::where('staff_id', '=', $id)->get();
        $staff = Staff::find($id);
        $event = [];
        foreach ($events as $row) {
            $enddate = $row->date."24:00:00";
            $event[] = \Calendar::event(
                $row->booking->booking_type->description,
                true,
                new \DateTime($row->booking->date),
                new \DateTime($row->booking->date),
                $row->staff_id,
                [
                    'url' => route('security_assignment.view', ['id' => $row->booking_id]),
                ]
            );
        }
        foreach ($rosters as $row){
            $enddate = $row->date."24:00:00";
            $event[] = \Calendar::event(
                'Work day',
                true,
                new \DateTime($row->date),
                new \DateTime($row->date),
                $row->staff_id,
                [
                    'color' => 'green',
                ]
            );
        }
        $calendar = \Calendar::addEvents($event);
        return view('Administration.staff.roster', compact('events', 'calendar'), ['staff' => $staff, 'rosters' => $rosters]);
    }

    //Create new roster.
    public function saveRoster(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $rosters = Roster::where('staff_id', '=', $id)->get();
        $staff_assignments = Staff_Assignment::where('staff_id', '=', $id)->get();
        foreach ($rosters as $record) {
            if($record->date == $request->date){
                return redirect()->back()->withErrors('This date is already in the roster.');
            }
        }
        foreach ($staff_assignments as $record) {
            if ($record->booking->date == $request->date) {
                return redirect()->back()->withErrors('This date has already been assigned activity.');
            }
        }

        $roster = new Roster([
            'staff_id' => $id,
            'date' => $request->input('date')
        ]);
        $roster->save();
        return redirect()->back();//->route('staff.roster', ['id' => $id]);
    }

    //Update the existing roster.
    public function uRoster(Request $request) {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|date_format:Y-m-d'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $roster = Roster::find($request->id);
        $rosters = Roster::where('staff_id', '=', $roster->staff_id)->get();
        $staff_assignments = Staff_Assignment::where('staff_id', '=', $roster->staff_id)->get();
        foreach ($rosters as $record) {
            if($record->date == $request->date){
                return redirect()->back()->withErrors('This date is already in the roster.');
            }
        }
        foreach ($staff_assignments as $record) {
            if ($record->booking->date == $request->date) {
                return redirect()->back()->withErrors('This date has already been assigned activity.');
            }
        }
        $roster->date = $request->input('date');
        $roster->save();
        return redirect()->back();
    }

    //Delete a roster.
    public function dRoster(Request $request) {
        $roster = Roster::find($request->id);
        $roster->delete();
        return redirect()->back();
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
            $user = $request->all();

            $date = today("NZ");
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
