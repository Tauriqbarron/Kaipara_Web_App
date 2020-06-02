<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function getLoginForm() {
        return view('Administration.login');
    }

    public function postLogin(Request $request) {
    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    $credentials = array(
        'email' => $request->input('email'),
        'password' => $request->input('password')
    );

    if(Auth::guard('admin')->attempt($credentials)){

        return redirect()->route('admin.index');
    }
    return redirect()->back()->withErrors("The email address or password is wrong.");
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
