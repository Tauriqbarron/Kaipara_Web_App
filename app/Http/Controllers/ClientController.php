<?php

namespace App\Http\Controllers;

use App\applications;
use App\Booking;
use App\Booking_Types;
use App\Clients;
use App\Job_Type;
use App\quote;
use App\service_provider;
use App\Service_Provider_Job;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $bookings = Booking::query()->where('client_id', '=', $client->id)
            ->where('date', '>=', today()->format('Y-m-d'))->get();
        $applications = applications::query()->where('client_id', '=', $client->id)
            ->where('date', '=', null)
            ->orWhere('date', '>=',  today()->format('Y-m-d'))->get();
        return view('Client.dashboard', ['client' => $client, 'bookings' => $bookings, 'applications' => $applications]);
    }
    //Update a client details.
    public function postEdit(Request $request) {
        $validator = Validator::make($request->all(), [
            'pNumber'=>'required|max:11',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            'postcode'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->route('security.index')
                ->withErrors($validator)
                ->withInput();
        }
        $client = Clients::query()->find(Auth::guard('client')->user()->id);
        $client->phone_number = $request->input('pNumber');
        $client->street = $request->input('street');
        $client->suburb = $request->input('suburb');
        $client->city = $request->input('city');
        $client->postcode = $request->input('postcode');
        $client->save();
        return redirect()->route('client.dashboard')->with('message', 'Details updated');
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
            applications::query()->select('id')->where('client_id', '=', $user->id)->get())
            ->where('status', '=',1)->get();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        return view('Client.quotes',['user'=>$user, 'quotes'=>$quotes, 'applications'=>$applications]);
    }

    public function getQuoteFilter($id){
        $user = auth()->guard('client')->user();
        $quotes = quote::query()->where('job_id', '=' , $id)
            ->where('status', '=', 1)->get();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        $filtered = true;
        return view('Client.quotes',['user'=>$user, 'quotes'=>$quotes, 'filtered'=>$filtered, 'applications'=>$applications]);
    }

    public function getAcceptedQuotes(){
        $user = auth()->guard('client')->user();
        $quotes = quote::query()->whereIn('job_id',
            applications::query()->select('id')->where('client_id', '=', $user->id)->get())
            ->where('status', '=',2)->get();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        $filtered = true;
        $accepted = true;
        return view('Client.quotes',['user'=>$user, 'quotes'=>$quotes, 'applications'=>$applications, 'filtered' => $filtered, 'accepted' => $accepted]);
    }

    public function getDeclinedQuotes(){
        $user = auth()->guard('client')->user();
        $quotes = quote::query()->whereIn('job_id',
            applications::query()->select('id')->where('client_id', '=', $user->id)->get())
            ->where('status', '=',3)->get();
        $applications = applications::query()->where('client_id', '=', $user->id)->get();
        $filtered = true;
        $accepted = false;
        return view('Client.quotes',['user'=>$user, 'quotes'=>$quotes, 'filtered'=>$filtered, 'applications'=>$applications, 'accepted' => $accepted]);
    }

    public function declineQuote($id){
        $quote = quote::query()->find($id);
        $quote->status = 3;
        return redirect()->back();
    }
    public function postAcceptQuote(Request $request){
        $quote = quote::query()->find($request->input('quote_id'));
        $application = $quote->application;
        $validator = Validator::make($request->all(), [
           'service_provider_id'=>'required|numeric',
           'quote_id' => 'required|exists:App\quote,id',
        ]);
        if($validator->fails() ){
            return redirect()->back()->withErrors($validator);
        }else{
            $application->price = $quote->price;
            $application->status = 2;
            $application->save();
            $service_provider_job = new Service_Provider_Job([
                'service_provider_id'=>$request->input('service_provider_id'),
                'job_id'=>$quote->job_id
            ]);
            $service_provider_job->save();
            $quote->status = 2;
            return redirect()->route('client.jobs')->with('message', 'Quote Accepted');
        }
    }

    public function getClientSettings(){
        $client = Clients::query()->find(Auth::guard('client')->user()->id);
        return view('Client.settings', ['client' => $client]);
    }

    public function changePasswordForm(){
        return view('Client.change_password');
    }

    public function changePassword(Request $request) {
        if(!(Hash::check($request->input('current_password'), Auth::guard('client')->user()->getAuthPassword()))) {
            return back()->withErrors('The current password of your account does not match with what you provided.');
        }

        if(strcmp($request->input('current_password'), $request->input('new_password')) == 0) {
            return back()->withErrors('The new password can not be the same as the current password.');
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:15|confirmed'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::guard('client')->user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        Auth::guard('client')->logout();
        Session::flush();
        if(!(Auth::guard('client')->check())){
            return redirect('/client/login')->withErrors(['Please log in with your new password']);
        }
        return back()->with('message', 'Password change successfully');
    }


}
