<?php

namespace App\Http\Controllers;

use App\service_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function createServiceProvider(Request $request)
    {
        error_log('validate start');
        //create function to store results validated so far
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:50|unique:service_providers',
            'username' => 'required|max:50',
            'pNumber' => 'required|max:20',
            'password' => 'required|max:20'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        else{
            error_log('data stored');
            $user = array(
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'phone_number' => $request->input('pNumber'),
                    'service' => $request->input('service')
            );

            error_log('data to session');
            $request->session()->put('userinfo',$user);
           return redirect()->route('reg.service.2');
        }
    }

    public function storeServiceProvider(Request $request){
        $userinfo = Session::has('userinfo') ? Session::get('userinfo'): null;

        $validator = Validator::make($request->all(),[
            'street'=>'required',
            'suburb' => 'required',
            'city'=>'required',
            'postcode'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
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
            return view('Service.Index',['user'=>$service_provider]);
        }

    }


    public function getUserType(){
        return view('Registration.usertype');
    }

    public function getServicePage1(){
        return view('Registration.ServiceReg.serviceRegForm');
    }
    public function getServicePage2(){
        return view('Registration.ServiceReg.serviceRegFormAddr');
    }
}
