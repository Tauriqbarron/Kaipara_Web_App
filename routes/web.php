<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/service', function () {
    return view('Service.serviceProfileTemplate');
}) ->name('service.home');

Route::get('/security', function () {
    return view('Security.index');
}) ->name('security.home');


/*Service Provider Booking Application Page*/
Route::get('/service/applications', function () {
    return view('Service.applications');
}) ->name('service.Bookings');


/*Administrator part (Jay) */
Route::get('/admin', function () {
    return view('Administration.index');
});

Route::get('/admin/assignment', function () {
    return view('Administration.assignment_management');
});

Route::get('/admin/client', function () {
    return view('Administration.client_management');
});

Route::get('/admin/staff', function () {
    return view('Administration.staff_management');
});

Route::get('/admin/provider', function () {
    return view('Administration.service_provider_management');
});







