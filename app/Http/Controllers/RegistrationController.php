<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function createServiceProvider(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'fName' => 'required|max:50',
            'lName' => 'required|max:50',
            'email' => 'required|email|max:50|unique:serviceproviders',
            'uName' => 'required|max:50',
            'pNumber' => 'required|max:20',
            'password' => 'required|confirmed|max:20'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $user = new \App\serviceprovider(
            [
                'firstname' => $request->input('firstname'),
                'lastname' => 'Storm',
                'username' => 'Jstorm',
                'email' => 'johnstorm@hotmail.co.nz',
                'password' => 'storm123',
                'phone_number' => '0213456782'
            ]
        );
        $user->save();

    }
}
