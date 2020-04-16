<?php

namespace App\Http\Controllers;

use App\serviceprovider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceProviderController extends Controller
{
    public function getIndex() {
        $serviceProviders = serviceprovider::all();
        return view('Administration.serviceProvider.index', ['serviceProviders' => $serviceProviders]);
    }

    public function getCreate() {
        return view('Administration.serviceProvider.sp_create');
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email|max:50|unique:serviceproviders',
            'uName'=>'required|max:50',
            'pNumber'=>'required|max:20',
            'password' => 'required|confirmed|max:20'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $serviceProvider = new serviceprovider([
            'firstname' => $request->input('fName'),
            'lastname' => $request->input('lName'),
            'email' => $request->input('email'),
            'username' => $request->input('uName'),
            'phone_number' => $request->input('pNumber'),
            'password'=> $request->input('password')
        ]);
        $serviceProvider->save();
        return redirect()->route('serviceProvider.index');
    }

}
