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


/* Client Routes  */

Route::get('/client/index', function () {
    return view('Client.index');
}) ->name('client.home');




/*Function Routes */
Route::post('register','RegistrationController@createServiceProvider');
Route::post('/provider','ServiceProviderController@login')->name('service.login.submit');
Route::post('registerAddrS','RegistrationController@storeServiceProvider' );
Route::post('/client','ClientController@login')->name('client.login.submit');

Route::get('/', function () {
    return view('index');
})->name('home.index');

Route::get('/test', function () {
    phpinfo();
});




/*Security Guard Profile*/
Route::get('/security/profile', [
    'uses' => 'StaffController@getHome', 'as' => 'security.index'
]);

Route::get('/security/accept/bookingid={booking_id}', [
    'uses' => "StaffController@acceptBooking", 'as' => 'security.acceptBooking'
]);

Route::get('/security/date{i}', [
    'uses' => "StaffController@dateChange", 'as' => 'security.dateChange'
]);

Route::get('/security/week{i}', [
    'uses' => "StaffController@setWeek", 'as' => 'security.setWeek'
]);


// SERVICE
/*Service Provider Profile*/

Route::get('/service', function () {
    return view('Service.index');
}) ->name('service.home');

Route::get('/canceljob/{id}',[
    'uses' =>'ServiceProviderController@canceljob',
    'as' => 'service.canceljob'
]);

Route::get('/acceptJob/{id}',[
    'uses' =>'ServiceProviderController@acceptJob',
    'as' => 'service.acceptJob'
]);

Route::get('/quote/{id}',[
    'uses' => 'ServiceProviderController@quote',
    'as' => 'service.quote'
]);

Route::get('/service/jobs', [
    'uses' => 'ServiceProviderController@getJobs', 'as' => 'service.jobs'
]) ->name('service.jobs');

/*Service Provider Booking Application Page*/
Route::get('/service/applications', [
    'uses' => 'ApplicationsController@getApps', 'as' => 'service.applications'
]) ->name('service.Bookings');

Route::get('service/logout', [
    'uses' => 'ServiceProviderController@serviceLogout',
    'as' => 'service.logout'
]);


/*Registration*/

Route::post('register','RegistrationController@createServiceProvider');


Route::get('/registration/usertype',[
    'uses' => 'RegistrationController@getUserType',
    'as' => "reg.type"
]);

Route::get('/registration/servicepage1',[
    'uses'=> 'RegistrationController@getServicePage1',
    'as'=>'reg.service.1'
]);


Route::get('/registration/servicepage2',[
    'uses'=> 'RegistrationController@getServicePage2',
    'as'=>'reg.service.1'
]);




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

/*Security Assignment Part*/
Route::get('/admin/sec-assignment', [
    'uses' => 'Auth\AdminSecurityAssignmentController@getIndex',
    'as' => 'security_assignment.index'
]);

Route::get('/admin/sec-assignment/result', [
    'uses' => 'Auth\AdminSecurityAssignmentController@search',
    'as' => 'security_assignment.search'
]);

Route::get('/admin/sec-assignment/create', [
    'uses' => 'Auth\AdminSecurityAssignmentController@getCreate',
    'as' => 'security_assignment.create'
]);

Route::post('/admin/sec-assignment/create', [
    'uses' => 'Auth\AdminSecurityAssignmentController@postCreate',
    'as' => 'security_assignment.create'
]);

Route::get('/admin/sec-assignment/view/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@view',
    'as' => 'security_assignment.view'
]);

Route::get('/admin/sec-assignment/assign{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@getAssign',
    'as' => 'security_assignment.assign'
]);

Route::post('/admin/sec-assignment/assign{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@postAssign',
    'as' => 'security_assignment.assign'
]);



/*Service Assignment Part*/


/*Client*/
Route::get('/admin/client', [
    'uses' => 'Auth\AdminClientController@getIndex',
    'as' => 'client.index'
]);

Route::get('/admin/client/result', [
    'uses' => 'Auth\AdminClientController@search',
    'as' => 'client.search'
]);

Route::get('/admin/client/create', [
    'uses' => 'Auth\AdminClientController@getCreate',
    'as' => 'client.create'
]);

Route::post('/admin/client/create', [
    'uses' => 'Auth\AdminClientController@postCreate',
    'as' => 'client.create'
]);

Route::get('/admin/client/{id}', [
    'uses' => 'Auth\AdminClientController@viewClient',
    'as' => 'client.view'
]);

Route::get('/admin/client/edit/{id}', [
    'uses' => 'Auth\AdminClientController@getEdit',
    'as' => 'client.edit'
]);

Route::post('/admin/client/edit/{id}', [
    'uses' => 'Auth\AdminClientController@postEdit',
    'as' => 'client.edit'
]);

Route::get('/admin/client/delete/{id}' , [
    'uses' => 'Auth\AdminClientController@getDelete',
    'as' => 'client.delete'
]);

Route::post('/admin/client/delete/{id}' , [
    'uses' => 'Auth\AdminClientController@postDelete',
    'as' => 'client.delete'
]);


/*staff*/
Route::get('/security/login', [
    'uses' => 'Auth\AdminStaffController@getLoginForm',
    'as' => 'staff.login'
]);

Route::get('security/logout', [
    'uses' => 'Auth\AdminStaffController@logout',
    'as' => 'staff.logout'
]);
Route::post('security/login', [
    'uses' => 'Auth\AdminStaffController@postLogin',
    'as' => 'staff.login'
]);

Route::get('/admin/staff',[
   'uses' => 'Auth\AdminStaffController@getIndex',
   'as' => "staff.index"
]);

Route::get('/admin/staff/result', [
    'uses' => 'Auth\AdminStaffController@getSearch',
    'as' => 'staff.search'
]);

Route::get('/admin/staff/create', [
    'uses' => 'Auth\AdminStaffController@getCreate',
    'as' => "staff.create"
]);

Route::post('/admin/staff/create',[
    'uses' => 'Auth\AdminStaffController@postCreate',
    'as' => "staff.create"
]);

Route::get('/admin/staff/view/{id}', [
    'uses' => 'Auth\AdminStaffController@viewStaff',
    'as' => "staff.view"
]);

Route::get('/admin/staff/edit/{id}',[
    'uses' => 'Auth\AdminStaffController@getEdit',
    'as' => "staff.edit"
]);

Route::post('/admin/staff/edit/{id}',[
    'uses' => 'Auth\AdminStaffController@postEdit',
    'as' => "staff.edit"
]);

Route::get('/admin/staff/delete/{id}',[
    'uses' => 'Auth\AdminStaffController@getDelete',
    'as' => "staff.delete"
]);

Route::post('/admin/staff/delete/{id}',[
    'uses' => 'Auth\AdminStaffController@postDelete',
    'as' => "staff.delete"
]);

/*Service Provider*/
Route::get('/admin/serviceProvider', [
    'uses' => 'Auth\AdminSpController@getIndex',
    'as' => 'sp.index'
]);

Route::get('/admin/serviceProvider/result', [
    'uses' => 'Auth\AdminSpController@getSearch',
    'as' => 'sp.search'
]);

Route::get('/admin/serviceProvider/create', [
    'uses' => 'Auth\AdminSpController@getCreate',
    'as' => 'sp.create'
]);

Route::post('/admin/serviceProvider/create', [
    'uses' => 'Auth\AdminSpController@postCreate',
    'as' => 'sp.create'
]);

Route::get('/admin/serviceProvider/view/{id}', [
    'uses' => 'Auth\AdminSpController@viewSp',
    'as' => 'sp.view'
]);

Route::get('/admin/serviceProvider/edit/{id}', [
    'uses' => 'Auth\AdminSpController@getEdit',
    'as' => 'sp.edit'
]);

Route::post('/admin/serviceProvider/edit/{id}', [
    'uses' => 'Auth\AdminSpController@postEdit',
    'as' => 'sp.edit'
]);

Route::get('/admin/serviceProvider/delete/{id}',[
    'uses' => 'Auth\AdminSpController@getDelete',
    'as' => "sp.delete"
]);

Route::post('/admin/serviceProvider/delete/{id}',[
    'uses' => 'Auth\AdminSpController@postDelete',
    'as' => "sp.delete"
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
