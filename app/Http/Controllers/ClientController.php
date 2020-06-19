<?php

namespace App\Http\Controllers;

use App\applications;
use App\Booking;
use App\Booking_Types;
use App\Clients;
use App\Job_Type;
use App\quote;
use App\service_provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Comparator\Book;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except(['login']);
    }

    public function getDashboard(){
        $client = Clients::query()->find(auth()->guard('client')->user()->id);
        $bookings = Booking::query()->where('client_id', '=', $client->id)->get();
        $applications = applications::query()->where('client_id', '=', $client->id)->get();
        return view('Client.dashboard', ['client' => $client, 'bookings' => $bookings, 'applications' => $applications]);
    }

    public function postCreateBooking(Request $request){

        $validator = Validator::make($request->all(), [
            'type' => 'required|exists:App\Booking_Types,description',
            'number1' => 'required|numeric',
            'message' => 'required|max:300',
            'street' => 'required',
            'suburb' => 'required',
            'city1' => 'required|',
            'postcode1' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'sometimes|date|after_or_equal:startDate',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i|after:startTime',
            'price' => 'required|numeric'
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator);
        }else{
            $endDate = $request->has('endDate') ? $request->input('endDate') : $request->input('startDate');
            $booking = new Booking([
                'client_id' => auth()->guard('client')->user()->id,
                'booking_type_id' => Booking_Types::query()->select('id')->where('description', '=', $request->input('type'))->firstOrFail()->id,
                'street' => $request->input('street'),
                'suburb' => $request->input('suburb'),
                'city' => $request->input('city1'),
                'postcode' => $request->input('postcode1'),
                'description' => $request->input('message'),
                'price' => $request->input('price'),
                'date' => $request->input('startDate'),
                'end_date' => $endDate,
                'start_time' => floatval(Carbon::parse($request->input('startTime'))->format("H.i")),
                'finish_time' => floatval(Carbon::parse($request->input('endTime'))->format("H.i")),
                'staff_needed' => $request->input('number1'),
                'available_slots' => $request->input('number1'),
            ]);
            $booking->save();
        }
        return redirect()->route('client.dashboard');
    }
    public function postCreateApplication(Request $request){

        $validator = Validator::make($request->all(), [
            'type' => 'required|exists:App\Job_Type,description',
            'title' => 'required|max:50',
            'description' => 'required|max:300',
            'street' => 'required',
            'suburb' => 'required',
            'city1' => 'required|',
            'postcode1' => 'required|numeric'
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator);
        }else{
            $application = new applications([
                'client_id' => auth()->guard('client')->user()->id,
                'job__type_id' => Job_Type::query()->select('id')->where('description', '=', $request->input('type'))->firstOrFail()->id,
                'street' => $request->input('street'),
                'suburb' => $request->input('suburb'),
                'city' => $request->input('city1'),
                'postcode' => $request->input('postcode1'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'date' => $request->input('startDate'),
                'title' => $request->input('title'),
                'status' => 1,

            ]);
            $application->save();
        }
        return redirect()->route('client.dashboard');
    }
    public function login(Request $request){
        //validate form

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $user_data = array(
            'email'=> $request->get('email'),
            'password' => $request->get('password')
        );
        $email = $request->get('email');
        // attempt login
        if(Auth::guard('client')->attempt($user_data))
        {
            $request->session()->put('guardString', 'client');
            //Session::put('user',$user);
            //if success redirect to profile
            return redirect()->route('client.dashboard');

        }

        //if unsuccessful redirect back to login
        else{
            return back()->with('error','Wrong Login Details');
        }
    }
    public function getSecurity(){
        $user = auth()->guard('client')->user();
        $booking_types = Booking_Types::all();
        return view('Client.security',['user'=>$user, 'booking_types'=>$booking_types]);
    }

    public function getProperty(){
        $user = auth()->guard('client')->user();
        $job_types = Job_Type::all();
        return view('Client.property',['user'=>$user, 'job_types'=>$job_types]);
    }

    public function getClientBookings(){
        $user = auth()->guard('client')->user();
        $bookings = Booking::query()->where('client_id', '=', $user->id)->get();
        return view('Client.bookings',['user'=>$user, 'bookings'=>$bookings]);
    }

    public function getClientJobs(){
        $user = auth()->guard('client')->user();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        return view('Client.jobs',['user'=>$user, 'applications'=>$applications]);
    }

    public function getAvailableJobs(){
        $user = auth()->guard('client')->user();
        $applications = applications::query()->where('client_id', '=', $user->id)
            ->where('status', '=', 1)->get();
        $filtered = true;
        return view('Client.jobs',['user'=>$user, 'applications'=>$applications, 'filtered'=>$filtered]);
    }

    public function getAssignedJobs(){
        $user = auth()->guard('client')->user();
        $applications = applications::query()->where('client_id', '=', $user->id)
            ->where('status', '!=', 1)->get();
        $filtered = true;
        return view('Client.jobs',['user'=>$user, 'applications'=>$applications, 'filtered'=>$filtered]);
    }

    public function getOlderJobs(){
        $user = auth()->guard('client')->user();
        $applications = applications::query()->where('client_id', '=', $user->id)
            ->where('date', '<', today('NZ')->format('Y-m-d'))->get();
        $filtered = true;
        return view('Client.jobs',['user'=>$user, 'applications'=>$applications, 'filtered'=>$filtered]);
    }

    public function getNewerJobs(){
        $user = auth()->guard('client')->user();
        $applications = applications::query()->where('client_id', '=', $user->id)
            ->where('date', '>=', today('NZ')->format('Y-m-d'))->get();
        $filtered = true;
        return view('Client.jobs',['user'=>$user, 'applications'=>$applications, 'filtered'=>$filtered]);
    }

    public function getAvailableBookings(){
        $user = auth()->guard('client')->user();
        $bookings = Booking::query()->where('client_id', '=', $user->id)
            ->where('status', '=', 'available')->get();
        $filtered = true;
        return view('Client.bookings',['user'=>$user, 'bookings'=>$bookings, 'filtered'=>$filtered]);
    }

    public function getAssignedBookings(){
        $user = auth()->guard('client')->user();
        $bookings = Booking::query()->where('client_id', '=', $user->id)
            ->where('status', '=', 'assigned')->get();
        $filtered = true;
        return view('Client.bookings',['user'=>$user, 'bookings'=>$bookings, 'filtered'=>$filtered]);
    }

    public function getCompletedBookings(){
        $user = auth()->guard('client')->user();
        $bookings = Booking::query()->where('client_id', '=', $user->id)
            ->where('status', '=', 'completed')->get();
        $filtered = true;
        return view('Client.bookings',['user'=>$user, 'bookings'=>$bookings, 'filtered'=>$filtered]);
    }

    public function getOlderBookings(){
        $user = auth()->guard('client')->user();
        $bookings = Booking::query()->where('client_id', '=', $user->id)
            ->where('date', '<', today('NZ')->format('Y-m-d'))->get();
        $filtered = true;
        return view('Client.bookings',['user'=>$user, 'bookings'=>$bookings, 'filtered'=>$filtered]);
    }

    public function getNewerBookings(){
        $user = auth()->guard('client')->user();
        $bookings = Booking::query()->where('client_id', '=', $user->id)
            ->where('date', '>=', today('NZ')->format('Y-m-d'))->get();
        $filtered = true;
        return view('Client.bookings',['user'=>$user, 'bookings'=>$bookings, 'filtered'=>$filtered]);
    }

    public function getQuotes(){
        $user = auth()->guard('client')->user();
        $quotes = quote::query()->whereIn('job_id',
            applications::query()->select('id')->where('client_id', '=', $user->id)->get())->get();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        return view('Client.quotes',['user'=>$user, 'quotes'=>$quotes, 'applications'=>$applications]);
    }

    public function getQuoteFilter($id){
        $user = auth()->guard('client')->user();
        $quotes = quote::query()->where('job_id', '=' , $id)->get();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        $filtered = true;
        return view('Client.quotes',['user'=>$user, 'quotes'=>$quotes, 'filtered'=>$filtered, 'applications'=>$applications]);
    }


}
