<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Feedback;
use App\Leave_Request;
use App\Roster;
use App\Staff;
use App\Staff_Assignment;
use App\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use MaddHatter\LaravelFullcalendar\Calendar;



class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function getHome() {

            $currentStaff = Staff::query()->find(Auth::guard('staff')->user()->id);
            $staff_assignments = $currentStaff->staff_assignments->pluck('booking_id');

            $bookings = Booking::query()->select('*')->whereIn('id', $staff_assignments)
                ->orWhere('available_slots', '>', '0')->get();


            $staff_bookings = $bookings->whereIn('id', $staff_assignments)
                ->where('date','<=', Carbon::parse(Session::get('date1'))->format('Y-m-d'))
                ->where('end_date','>=', Carbon::parse(Session::get('date1'))->format('Y-m-d'))
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $availableBookings = $bookings->whereNotIn('id', $staff_assignments)
                ->where('date', '>=', today("NZ"))
                ->where('available_slots','>','0')
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $completedBookings = $bookings->whereIn('id', $staff_assignments)
                ->where('date', '<=', today("NZ"))
                ->where('status', '=', "complete")
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $timetable = $bookings->whereIn('id', $staff_assignments)
                ->whereBetween('date', array(Session::get('weekStart'), Session::get('weekEnd')))
                ->sortBy('date',1)
                ->sortBy('start_time', 1);

            $timesheets = Timesheet::query()->whereIn('staff__assignment_id',
                Staff_Assignment::query()->select('id')->where('staff_id','=', $currentStaff->id)->get())
                ->orderBy('id', 'desc')->get();

            return view('Security.index', $this->getCalendar(),['timesheets'=>$timesheets, 'staff_assignments' => $staff_assignments, 'staff' => $currentStaff, 'bookings' => $staff_bookings,'completedBookings' => $completedBookings, 'availableBookings' => $availableBookings, 'timetable' => $timetable, 'allBookings' => $bookings]);

    }

    public function postFeedback(Request $request){
        $validator = Validator::make($request->all(), [
           'rating' => 'required|numeric|max:5|min:1',
           'message' => 'required|max:300',
           'staff_assignment_id' => 'required|numeric|exists:App\Staff_Assignment,id'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $staff_assignment = Staff_Assignment::query()->find($request->input('staff_assignment_id'));
        $client = $staff_assignment->booking->client;

        $feedback = new Feedback([

            'rating' => $request->get('star'),
            'message'=> $request->get('message'),
            'staff__assignment_id'=> $request->get('staff_assignment_id'),
            'staff_id' => auth()->guard('staff')->user()->id,
            'client_id' => $client->id
        ]);
        $feedback->save();

        return redirect()->back()->with('message', 'Feedback Sent');
    }

    public function dateChange($i){
        Session::put('page', 'profile');
        $currentDate = Session::get('date1');
        $currentDate->addDays($i);

        Session::put('date1', $currentDate);

        return redirect()->route('security.index');

    }

    public function setWeek($i){
        $j = $i*7;
        $weekStart = Session::get('weekStart');
        $weekEnd = Session::get('weekEnd');

        $weekStart = $weekStart->addDays($j);
        $weekEnd = $weekEnd->addDays($j);

        Session::put('weekStart', $weekStart);
        Session::put('weekEnd', $weekEnd);

        return redirect()->route('security.index');
    }

    public function acceptBooking($booking_id) {
        $user = auth()->guard('staff')->user();
        $staff_id = $user->id;
        $staff = Staff::query()->find($staff_id);
        $staff_assignments = $staff->staff_Assignments;
        $booking = Booking::query()->find($booking_id);

        foreach($staff_assignments as $staff_assignment){

            $theBooking = $staff_assignment->booking;
            $theBookingDate = Carbon::parse($theBooking->date);
            $theBookingEndDate = Carbon::parse($theBooking->end_date);
            $bookingDate = Carbon::parse($booking->date);
            $bookingEndDate = Carbon::parse($booking->end_date);
            $theBookingStartTime = $theBooking->start_time;
            $bookingStartTime = $booking->start_time;
            $theBookingFinishTime = $theBooking->finish_time;
            $bookingFinishTime = $theBooking->finish_time;
            $sameDate = ($theBookingDate->lessThanOrEqualTo($bookingEndDate) && $bookingDate->lessThanOrEqualTo($theBookingEndDate));
            $sameStartTime = ($theBookingStartTime >= $bookingStartTime) && ($theBookingStartTime <= $bookingFinishTime);
            $sameFinishTime = ($theBookingFinishTime <= $bookingFinishTime) && ($theBookingFinishTime >= $bookingStartTime);

            if($sameDate && ($sameStartTime || $sameFinishTime)){
                return redirect()->back()->with('error', 'Could not accept booking due to Roster conflict');
            }
        }
        foreach($staff->leave_requests as $request){

            $requestDate = Carbon::parse($request->start_date);
            $requestEndDate = Carbon::parse($request->end_date);
            $bookingDate = Carbon::parse($booking->date);
            $bookingEndDate = Carbon::parse($booking->end_date);
            $sameDate = ($requestDate->lessThanOrEqualTo($bookingEndDate) && $bookingDate->lessThanOrEqualTo($requestEndDate));

            if($sameDate){
                return redirect()->back()->with('error', 'Could not accept booking due to Roster conflict');
            }
        }

        if($booking->status == 'available') {
            $assignment = new Staff_Assignment([
                'staff_id' => $staff_id,
                'booking_id' => $booking_id
            ]);
            $assignment->save();

            $booking->available_slots -= 1;

            if($booking->available_slots == 0){
                $booking->status = 'assigned';
            }
            $booking->save();
        }
        return redirect()->route('security.index');
    }

    public function postLeave(Request $request){
        $validator = Validator::make($request->all(), [
            'subject'=>'required|max:50',
            'message'=>'required|max:300',
            'type'=>'required',
            'startDate'=>'required',
            'EndDate'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->route('security.index')
                ->withErrors($validator)
                ->withInput();
        }

        $leaveRequest = new Leave_Request([
           'subject' => $request->get('subject'),
           'message' => $request->get('message'),
           'absence_types_id' => $request->get('type'),
           'absence_status_id' => 1,
           'start_date' => $request->get('startDate'),
           'end_date' => $request->get('EndDate'),
           'staff_id' => auth()->guard('staff')->user()->id
        ]);
        $leaveRequest->save();
        return redirect()->route('security.index')->with('message', 'Leave Request Sent');

    }

    //Update a staff details.
    public function postEdit(Request $request) {
        $validator = Validator::make($request->all(), [
            'pNumber'=>'required|max:13|regex:/^(\(02[0-9]{1}\)\-)([0-9]{7})/',
            'street'=>'required|regex:/^[A-Za-z0-9\s?]+$/',
            'suburb'=>'required|regex:/^[A-Za-z\s?]+$/',
            'city'=>'required|regex:/^[A-Za-z\s?]+$/',
            'postcode'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $staff = Staff::query()->find(Auth::guard('staff')->user()->id);
        $staff->phone_number = $request->input('pNumber');
        $staff->street = $request->input('street');
        $staff->suburb = $request->input('suburb');
        $staff->city = $request->input('city');
        $staff->postcode = $request->input('postcode');
        $staff->save();
        return redirect()->back()->with('message', 'Details updated');
    }

    public function getCalendar() {
        $id = auth()->guard('staff')->user()->id;
        $events = Staff_Assignment::where('staff_id', '=', $id)->get();
        $rosters = Roster::where('staff_id', '=', $id)->get();
        $staff = Staff::find($id);
        $leave = $staff->leave_requests->where('absence_status_id', '=', 2);
        $event = [];
        foreach ($events as $row) {
            $enddate = $row->date."24:00:00";
            $start_time = sprintf('%02d:%02d:00', (int) $row->booking->start_time, round(fmod($row->booking->start_time, 1) * 100));
            $finish_time = sprintf('%02d:%02d:00', (int) $row->booking->finish_time, round(fmod($row->booking->finish_time, 1) * 100));
            $event[] = \Calendar::event(
                $row->booking->booking_type->description,
                false,
                new \DateTime($row->booking->date . ' ' . $start_time),
                new \DateTime($row->booking->end_date . ' ' . $finish_time),
                $row->staff_id,
                [
                    'url' => route('security.dateChange',['i'=>count(\Carbon\Carbon::parse('1970-01-01')->daysUntil($row->booking->date)->toArray()) - count(\Carbon\Carbon::Parse('1970-01-01')->daysUntil(\Illuminate\Support\Facades\Session::get('date1'))->toArray())]),
                    'color' => '#dd504c',
                    'textColor'=>'white'
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
                    'color' => '#67c76c',
                    'textColor'=>'white'
                ]
            );
        }
        foreach ($leave as $row){
            $enddate = $row->date."24:00:00";
            $event[] = \Calendar::event(
                'Annual Leave',
                true,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->staff_id,
                [
                    'color' => '#5f94e8',
                    'textColor'=>'white'
                ]
            );
        }
        $calendar = \Calendar::addEvents($event);
        return compact('events', 'calendar');
    }


}
