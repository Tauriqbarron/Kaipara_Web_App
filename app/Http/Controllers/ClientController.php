<?php

namespace App\Http\Controllers;

use App\applications;
use App\Booking;
use App\Clients;
use App\service_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function getDashboard(){
        $client = Clients::query()->find(\auth()->guard('client')->user()->id);
        $bookings = Booking::query()->where('client_id', '=', $client->id);
        $applications = applications::query()->where('client_id', '=', $client->id);
        return view('Client.dashboard', ['client' => $client, 'bookings' => $bookings, 'applications' => $applications]);
    }

    public function postCreateBooking(Request $request){
        return redirect()->back();
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
