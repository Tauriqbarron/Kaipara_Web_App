<?php

namespace App\Http\Controllers;

use App\Clients;
use App\service_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
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
