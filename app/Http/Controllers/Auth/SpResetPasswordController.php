<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use Illuminate\Http\Request;
use Password;

class SpResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/'; //RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:service_provider');
    }

    protected function guard()
    {
        return Auth::guard('service_provider');
    }

    protected function broker() {
        return Password::broker('service_providers');
    }

    public function showResetForm(Request $request, $token = null)
    {
        auth()->guard('staff')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return view('passwords.reset-sp')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
