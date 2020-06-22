<?php

namespace App\Http\Controllers;

use App\applications;
use App\Booking;
use App\Booking_Types;
use App\Client_Feedback;
use App\Client_Service_Feedback;
use App\Clients;
use App\Job_Type;
use App\quote;
use App\service_provider;
use App\Service_Provider_Job;
use App\Staff_Assignment;
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
        $applications = applications::query()->where('client_id', '=', $client->id)->get();
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
            $jobtype = Job_Type::query()->where('description', '=', $request->input('type'))->firstOrFail();
            $application = new applications([
                'client_id' => auth()->guard('client')->user()->id,
                'job__type_id' => $jobtype->id,
                'street' => $request->input('street'),
                'suburb' => $request->input('suburb'),
                'city' => $request->input('city1'),
                'postCode' => $request->input('postcode1'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'date' => $request->input('startDate'),
                'title' => $request->input('title'),
                'imagePath' =>$jobtype->imgPath,
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
            ->where('status', '=', 'complete')->get();
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

    public function postFeedback(Request $request){
        $validator = Validator::make($request->all(), [
            'star' => 'required|numeric|max:5|min:1',
            'message' => 'required|max:300',
            'staff_assignment_id' => 'required|numeric|exists:App\Staff_Assignment,id'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $staff_assignment = Staff_Assignment::query()->find($request->input('staff_assignment_id'));
        $staff = $staff_assignment->staff;

        $clientFeedback = new Client_Feedback([
            'rating' => $request->get('star'),
            'message'=> $request->get('message'),
            'staff__assignment_id'=> $request->get('staff_assignment_id'),
            'staff_id' => auth()->guard('client')->user()->id,
            'client_id' => $staff->id
        ]);
        $clientFeedback->save();
        return redirect()->back()->with('message', 'Feedback Posted');
    }

    public function postServiceFeedback(Request $request){
        $validator = Validator::make($request->all(), [
            'star' => 'required|numeric|max:5|min:1',
            'message' => 'required|max:300',
            'service_provider_job_id' => 'required|numeric|exists:App\Service_Provider_Job,id'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $service_provider_job = Service_Provider_Job::query()->find($request->input('service_provider_job_id'));
        $service_provider = $service_provider_job->service_provider;

        $clientFeedback = new Client_Service_Feedback([
            'rating' => $request->get('star'),
            'message'=> $request->get('message'),
            'service__provider__job_id'=> $request->get('service_provider_job_id'),
            'client_id' => auth()->guard('client')->user()->id,
            'service_provider_id' => $service_provider->id
        ]);
        $clientFeedback->save();
        return redirect()->back()->with('message', 'Feedback Posted');
    }

    public function getImageUpload(){
        return view("Client.upload_image");
    }

    public function postImageUpload(){

        $userId = Auth::guard('client')->user()->id;
        $user = Clients::query()->find($userId);

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);



        $imageName = time().'.'.request()->image->getClientOriginalExtension();




        request()->image->move(public_path('images'), $imageName);
        $user->imgPath = 'images/' . $imageName;
        $user->save();

        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName);

    }


}
