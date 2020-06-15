<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;

class StaffResetPasswordController extends Controller
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
    protected $redirectTo = 'security/login';

    public function __construct()
    {
        $this->middleware('guest:staff');
    }

    protected function guard()
    {
        return Auth::guard('staff');
    }

    protected function broker()
    {
        return Password::broker('staffs');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('passwords.reset-staff')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
