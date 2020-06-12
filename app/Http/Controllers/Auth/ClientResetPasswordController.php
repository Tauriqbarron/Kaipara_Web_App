<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;
use Illuminate\Http\Request;

class ClientResetPasswordController extends Controller
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
    protected $redirectTo = '/client/login';

    public function __construct()
    {
        $this->middleware('guest:client');
    }

    public function guard()
    {
        return Auth::guard('client');
    }

    protected function broker() {
        return Password::broker('clients');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('passwords.reset-client')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
