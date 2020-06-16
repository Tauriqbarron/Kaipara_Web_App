<?php

namespace App\Http\Controllers;

use App\applications;
use App\Booking;
use App\Booking_Types;
use App\Clients;
use App\service_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except(['login']);
    }

    public function getDashboard(){
        $client = Clients::query()->find(\auth()->guard('client')->user()->id);
        $bookings = Booking::query()->where('client_id', '=', $client->id);
        $applications = applications::query()->where('client_id', '=', $client->id);
        return view('Client.dashboard', ['client' => $client, 'bookings' => $bookings, 'applications' => $applications]);
    }

    public function postCreateBooking(Request $request){

        $validator = Validator::make($request->all(), [
            'type' => 'required',
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
            'price' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator);
        }else{
            $endDate = $request->has('endDate') ? $request->input('endDate') : $request->input('startDate');
            $booking = new Booking([
                'client_id' => auth()->guard('client')->user()->id,
                'booking_type_id' => Booking_Types::query()->select('id')->where('description', '=', $request->input('type'))->firstOrFail(),
                'street' => $request->input('street'),
                'suburb' => $request->input('suburb'),
                'city' => $request->input('city1'),
                'postcode' => $request->input('postcode1'),
                'description' => $request->input('message'),
                'price' => $request->input('price'),
                'start_date' => $request->input('startDate'),
                'end_date' => $endDate,
                'start_time' => $request->input('startTime'),
                'end_time' => $request->input('endTime'),
                'staff_needed' => $request->input('number1'),
                'available' => $request->input('number1'),
            ]);
        }
        return redirect('jhkjgkjhlkjhkl')->back();
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

            $user = Clients::query()->where('email',$email)->first();
            $request->session()->put('user',$user);
            $request->session()->put('guardString', 'client');
            //Session::put('user',$user);
            //if success redirect to profile
            return view('Client.index',['user'=>$user]) ;

        }

        //if unsuccessful redirect back to login
        else{
            return back()->with('error','Wrong Login Details');
        }
    }
    public function getSecurity(){
        $user = Session::has('user') ? Session::get('user'): null;
        return view('Client.security',['user'=>$user]);
    }

    public function getProperty(){
        $user = Session::has('user') ? Session::get('user'): null;
        return view('Client.property',['user'=>$user]);
    }


}
