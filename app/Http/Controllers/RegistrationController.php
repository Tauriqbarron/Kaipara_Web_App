<?php

namespace App\Http\Controllers;

use App\Clients;
use App\service_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    //Get the select sign up user type page
    public function getUserType(){
        return view('Registration.usertype');
    }

 //Service provider sign up function group//
    //Get the first registration form for client.
    public function getClientRegPage1() {
        return view('Registration.ClientReg.clientRegForm');
    }

    //Save the first form data to session.
    public function createClient(Request $request) {
        //create function to store results validated so far
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:50|unique:clients',
            'pNumber' => 'required|max:20',
            'password' => 'required|confirmed|max:20'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors('Please fill in the form with valid information')->withInput($request->all());
        }
        else{
            $user = array(
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone_number' => $request->input('pNumber'),
            );
            $request->session()->put('userinfo',$user);
            return redirect()->route('reg.client.2');
        }
    }

    //Get the second registration form for client.
    public function getClientRegPage2() {
        return view('Registration.ClientReg.clientRegFormAddr');
    }

    //Save all data and create a new service provider account.
    public function storeClient(Request $request){
        $userinfo = Session::has('userinfo') ? Session::get('userinfo'): null;
        $validator = Validator::make($request->all(),[
            'street'=>'required',
            'suburb' => 'required',
            'city'=>'required',
            'postcode'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors('Please fill in the form with valid information')->withInput($request->all());
        }
        else{
            $client = new Clients([
                'first_name'=> $userinfo['firstname'],
                'last_name' => $userinfo['lastname'],
                'email' => $userinfo['email'],
                'password'=> Hash::make($userinfo['password']),
                'phone_number'=> $userinfo['phone_number'],
                'street'=> $request->input('street'),
                'suburb'=> $request->input('suburb'),
                'city'=> $request->input('city'),
                'postcode'=> $request->input('postcode')
            ]);
            $client->save();
            $request->session()->put('user',$client);
            return redirect('/client/login')->with('message', 'Sign up successfully, try to login now.');
        }
    }



 //Service provider sign up function group//
    //Get the first registration form for service provider.
    public function getServicePage1(){
        return view('Registration.ServiceReg.serviceRegForm');
    }

    //Save the first form data to session.
    public function createServiceProvider(Request $request)
    {
        //create function to store results validated so far
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:50|unique:service_providers',
            'username' => 'required|max:50',
            'pNumber' => 'required|max:20',
            'password' => 'required|confirmed|max:20'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors('Please fill in the form with valid information')->withInput($request->all());
        }
        else{
            $user = array(
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'phone_number' => $request->input('pNumber'),
                    'service' => $request->input('service')
            );
            $request->session()->put('userinfo',$user);
           return redirect()->route('reg.service.2');
        }
    }

    //Get the second registration form for service provider.
    public function getServicePage2(){
        return view('Registration.ServiceReg.serviceRegFormAddr');
    }

    //Save all data and create a new service provider account.
    public function storeServiceProvider(Request $request){
        $userinfo = Session::has('userinfo') ? Session::get('userinfo'): null;
        $validator = Validator::make($request->all(),[
            'street'=>'required',
            'suburb' => 'required',
            'city'=>'required',
            'postcode'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors('Please fill in the form with valid information')->withInput($request->all());
        }
        else{
            $service_provider = new service_provider([
                'firstname'=> $userinfo['firstname'],
                'lastname' => $userinfo['lastname'],
                'username' => $userinfo['username'],
                'email' => $userinfo['email'],
                'password'=> Hash::make($userinfo['password']),
                'phone_number'=> $userinfo['phone_number'],
                'street'=> $request->input('street'),
                'suburb'=> $request->input('suburb'),
                'city'=> $request->input('city'),
                'postcode'=> $request->input('postcode')
            ]);
            $service_provider->save();
            $request->session()->put('user',$service_provider);
            return redirect('/service_provider/login')->with('message', 'Sign up successfully, try to login now.');
        }
    }
}
