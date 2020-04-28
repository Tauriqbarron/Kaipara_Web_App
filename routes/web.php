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


//Client Route



/*Login Routes */

  /*Select User Type*/
Route::get('/selectuser', function () {
    return view('login/userselect.usertype');
});
Route::get('/client', function () {
    return view('login.userlogin');
});
Route::get('/provider', function () {
    return view('login.servicelogin');
});

Route::post('/provider','ServiceProviderController@login')->name('service.login.submit');


/*Function Routes */
Route::post('register','RegistrationController@createServiceProvider');

Route::get('/', function () {
    return view('index');
})->name('home.index');

Route::get('/test', function () {
    phpinfo();
});

/*Security Guard Profile*/
Route::get('/security', [
    'uses' => 'StaffController@getHome', 'as' => 'security.index'
]) ->name('security.home');

/*Service Provider Profile*/
Route::get('/service', function () {
    return view('Service.index');
}) ->name('service.home');

/*Service Provider Booking Application Page*/
Route::get('/service/applications', [
    'uses' => 'ApplicationsController@getApps', 'as' => 'service.applications'
]) ->name('service.Bookings');

/*Service Provider jobs Page*/
Route::get('/service/jobs', function () {
    return view('Service.jobs');
}) ->name('service.jobs');

/*Registration*/
Route::get('/registration', function () {
    return view('Registration.index');
}) ->name('Registration.index');


/*Administrator part (Jay) */
/*Select Staff Type*/
Route::get('/selectstaff', function () {
    return view('login.userselect.stafftype');
});

/*Admin login*/
Route::get('/admin/home', [
    'uses' => 'Auth\AdminController@adminIndex',
    'as' => 'admin.index'
]);

Route::get('admin/login', [
    'uses' => 'Auth\AdminController@getLoginForm',
    'as' => 'admin.login'
]);

Route::post('admin/login', [
    'uses' => 'Auth\AdminController@postLogin',
    'as' => 'admin.login'
]);

Route::get('admin/logout', [
    'uses' => 'Auth\AdminController@logout',
    'as' => 'admin.logout'
]);

Route::get('/admin/assignment', function () {
    return view('Administration.assignment_management');
});

Route::get('/admin/client', function () {
    return view('Administration.client_management');
});

/*staff*/
Route::get('/security/login', [
    'uses' => 'StaffController@getLoginForm',
    'as' => 'staff.login'
]);

Route::post('security/login', [
    'uses' => 'StaffController@postLogin',
    'as' => 'staff.login'
]);

Route::get('/admin/staff',[
   'uses' => 'StaffController@getIndex',
   'as' => "staff.index"
]);

Route::get('/admin/result', [
    'uses' => 'StaffController@getSearch',
    'as' => 'staff.search'
]);

Route::get('/admin/staff/create',[
    'uses' => 'StaffController@getCreate',
    'as' => "staff.create"
]);

Route::post('/admin/staff/create',[
    'uses' => 'StaffController@postCreate',
    'as' => "staff.create"
]);

Route::get('/admin/staff/edit/{id}',[
    'uses' => 'StaffController@getEdit',
    'as' => "staff.edit"
]);

Route::post('/admin/staff/edit/{id}',[
    'uses' => 'StaffController@postEdit',
    'as' => "staff.edit"
]);

Route::get('/admin/staff/delete/{id}',[
    'uses' => 'StaffController@getDelete',
    'as' => "staff.delete"
]);

Route::post('/admin/staff/delete/{id}',[
    'uses' => 'StaffController@postDelete',
    'as' => "staff.delete"
]);

/*Service Provider*/
Route::get('/admin/serviceProvider', [
    'uses' => 'ServiceProviderController@getIndex',
    'as' => 'sp.index'
]);

Route::get('/admin/serviceProvider/create', [
    'uses' => 'ServiceProviderController@getCreate',
    'as' => 'sp.create'
]);

Route::post('/admin/serviceProvider/create', [
    'uses' => 'ServiceProviderController@postCreate',
    'as' => 'sp.create'
]);

Route::get('/admin/serviceProvider/edit/{id}', [
    'uses' => 'ServiceProviderController@getEdit',
    'as' => 'sp.edit'
]);

Route::post('/admin/serviceProvider/edit/{id}', [
    'uses' => 'ServiceProviderController@postEdit',
    'as' => 'sp.edit'
]);

Route::get('/admin/serviceProvider/delete/{id}',[
    'uses' => 'ServiceProviderController@getDelete',
    'as' => "sp.delete"
]);

Route::post('/admin/serviceProvider/delete/{id}',[
    'uses' => 'ServiceProviderController@postDelete',
    'as' => "sp.delete"
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
