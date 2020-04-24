<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // attempt login
        if(Auth::guard('client')->attempt($user_data))
        {
            //if success redirect to profile
            return redirect($this->loginSuccess());
        }
        //if unsuccessful redirect back to login
        else{
            return back()->with('error','Wrong Login Details');
        }
    }


    public function loginSuccess(){
        return view('Client.clientProfileTemplate');
    }
}
