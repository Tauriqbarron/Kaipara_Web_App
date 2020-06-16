<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Check out Error Handling #render for more information
        // render method is responsible for converting a given exception into an HTTP response
        // Catch AthenticationException and redirect back to somewhere else...
        /*if($exception instanceof AuthenticationException){
            $guard = Array($exception->guards(), 0);
            switch($guard){
                case 'admin':
                    return redirect(route('admin.login'));
                    break;
                default:
                    return redirect(route('login'));
                    break;
            }
        }*/

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        /*if ($request->expectsJson()) {

            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = Array($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->route($login);
    }*/
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/admin/login');
        }
        if ($request->is('service_provider') || $request->is('service_provider/*')) {
            return redirect()->guest('/service_provider/login');
        }
        if ($request->is('security') || $request->is('security/*')) {
            error_log($exception->getMessage());
            return redirect()->guest('/security/login');
        }
        if ($request->is('client') || $request->is('client/*')) {
            error_log($exception->getMessage());
            return redirect()->guest('/client/login');
        }
        return redirect()->guest(route('login'));
    }
}
