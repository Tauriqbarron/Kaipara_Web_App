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

/*Registration*/
Route::get('/registration/usertype',[
    'uses' => 'RegistrationController@getUserType',
    'as' => "reg.type"
]);

/*Login Routes */

  /*Select User Type*/
Route::get('/selectuser', function () {
    return view('login/userselect.usertype');
});
Route::get('/client/login', function () {
    return view('login.userlogin');
});
Route::get('/service_provider/login', function () {
    return view('login.servicelogin');
});


/* Client Routes  */
Route::get('/client/index', function () {
    return view('Client.index');
}) ->name('client.home');

Route::get('/client/security', [
    'uses' => 'ClientController@getSecurity',
    'as' => 'client.security'
]);

Route::get('/client/property', [
    'uses' => 'ClientController@getProperty',
    'as' => 'client.property'
]);


Route::prefix('client')->group(function (){
    /*Client Registration*/
    Route::get('/registration/getClientRegPage1',[
        'uses'=> 'RegistrationController@getClientRegPage1',
        'as'=>'reg.client.1'
    ]);

    Route::post('/registration/create',[
        'uses' => 'RegistrationController@createClient',
        'as' => 'reg.client.putToSession'
    ]);

    Route::get('/registration/servicepage2',[
        'uses'=> 'RegistrationController@getClientRegPage2',
        'as'=>'reg.client.2'
    ]);

    Route::post('/registration/address/save',[
        'uses' => 'RegistrationController@storeClient',
        'as' => 'reg.client.save'
    ]);
    /*Client Registration End*/

    /*Service provider reset password part*/
    Route::post('/password/email', [
        'uses' => 'Auth\ClientForgotPasswordController@sendResetLinkEmail',
        'as' => 'client.password.email'
    ]);

    Route::get('/password/reset', [
        'uses' => 'Auth\ClientForgotPasswordController@showLinkRequestForm',
        'as' => 'client.password.request'
    ]);

    Route::post('/password/reset', [
        'uses' => 'Auth\ClientResetPasswordController@reset',
        'as' => 'client.password.update'
    ]);

    Route::get('/password/reset/{token}', [
        'uses' => 'Auth\ClientResetPasswordController@showResetForm',
        'as' => 'client.password.reset'
    ]);

});





/*Function Routes */


Route::post('/service_provider','ServiceProviderController@login')->name('service.login.submit');

Route::post('/client','ClientController@login')->name('client.login.submit');

Route::get('/', function () {
    return view('Index');
});

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


Route::post('/security/start','TimesheetController@start')->name('staff.startJob');
Route::post('/security/stop','TimesheetController@stop')->name('staff.stopJob');
Route::post('/security/rating','staffController@postFeedback')->name('staff.postFeedback');
Route::post('/security/leaveApplication','staffController@postLeave')->name('staff.postLeave');
Route::post('/security/editInfo','staffController@postEdit')->name('security.postEdit');

//Staff reset password//
Route::prefix('security')->group(function (){
    Route::post('/password/email', [
        'uses' => 'Auth\StaffForgotPasswordController@sendResetLinkEmail',
        'as' => 'staff.password.email'
    ]);

    Route::get('/password/reset', [
        'uses' => 'Auth\StaffForgotPasswordController@showLinkRequestForm',
        'as' => 'staff.password.request'
    ]);

    Route::post('/password/reset', [
        'uses' => 'Auth\StaffResetPasswordController@reset',
        'as' => 'staff.password.update'
    ]);

    Route::get('/password/reset/{token}', [
        'uses' => 'Auth\StaffResetPasswordController@showResetForm',
        'as' => 'staff.password.reset'
    ]);
});



// SERVICE
/*Service Provider Profile*/
Route::get('/service_provider', function () {
    return view('Service.index');
}) ->name('service.home');

Route::post('service_provider/canceljob/{id}',[
    'uses' =>'ServiceProviderController@canceljob',
    'as' => 'service.canceljob'
]);

Route::get('service_provider/acceptJob/{id}',[
    'uses' =>'ServiceProviderController@acceptJob',
    'as' => 'service.acceptJob'
]);

Route::post('service_provider/quote/{id}',[
    'uses' => 'ServiceProviderController@quote',
    'as' => 'service.quote'
]);

Route::get('service_provider/quote',[
    'uses' => 'ServiceProviderController@viewQuote',
    'as' => 'service.view_quote'
]);

Route::post('service_provider/cancel_quote/{id}', [
    'uses' => 'ServiceProviderController@cancelQuote',
    'as' => 'service.cancel_quote'
]);

Route::get('/service_provider/jobs', [
    'uses' => 'ServiceProviderController@getJobs',
    'as' => 'service.jobs'
]);

Route::get('/service_provider/jobs/start_job/{id}', [
    'uses' => 'ServiceProviderController@startJob',
    'as' => 'service.job.start'
]);

Route::get('/service_provider/jobs/complete_job/{id}', [
    'uses' => 'ServiceProviderController@completeJob',
    'as' => 'service.job.complete'
]);

Route::get('/service_provider/jobs/completed_jobs', [
    'uses' => 'ServiceProviderController@getCompletedJobs',
    'as' => 'service.completed_jobs'
]);

/*Service Provider Booking Application Page*/
Route::get('/service_provider/applications', [
    'uses' => 'ApplicationsController@getApps',
    'as' => 'service.applications'
]);

Route::get('service_provider/logout', [
    'uses' => 'ServiceProviderController@serviceLogout',
    'as' => 'service.logout'
]);

/*Service provider prefix group*/
Route::prefix('service_provider')->group(function (){
    /*Service Provider Registration*/
    Route::get('/registration/servicepage1',[
        'uses'=> 'RegistrationController@getServicePage1',
        'as'=>'reg.service.1'
    ]);

    Route::post('/registration/create',[
        'uses' => 'RegistrationController@createServiceProvider',
        'as' => 'reg.service.putToSession'
    ]);

    Route::get('/registration/servicepage2',[
        'uses'=> 'RegistrationController@getServicePage2',
        'as'=>'reg.service.2'
    ]);

    Route::post('/registration/address/save',[
        'uses' => 'RegistrationController@storeServiceProvider',
        'as' => 'reg.service.save'
    ]);
    /*Service Provider Registration End*/

    /*Service provider reset password part*/
    Route::post('/password/email', [
       'uses' => 'Auth\SpForgotPasswordController@sendResetLinkEmail',
       'as' => 'sp.password.email'
    ]);

    Route::get('/password/reset', [
        'uses' => 'Auth\SpForgotPasswordController@showLinkRequestForm',
        'as' => 'sp.password.request'
    ]);

    Route::post('/password/reset', [
        'uses' => 'Auth\SpResetPasswordController@reset',
        'as' => 'sp.password.update'
    ]);

    Route::get('/password/reset/{token}', [
        'uses' => 'Auth\SpResetPasswordController@showResetForm',
        'as' => 'sp.password.reset'
    ]);
});







/*Administrator part */
/*Select Staff Type*/
Route::get('/selectstaff', function () {
    return view('login.userselect.stafftype');
});

/*Admin login*/
Route::get('admin/login', [
    'uses' => 'Auth\AdminController@getLoginForm',
    'as' => 'admin.login'
]);

Route::post('admin/login', [
    'uses' => 'Auth\AdminController@postLogin',
    'as' => 'admin.login'
]);

Route::get('/admin', [
    'uses' => 'Auth\AdminClientController@adminIndex',
    'as' => 'admin.index'
]);

Route::get('admin/logout', [
    'uses' => 'Auth\AdminController@logout',
    'as' => 'admin.logout'
]);

/*Security Assignment Part
Route::group(['middleware' => ['auth:admin']], function (){

});*/

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

Route::get('/admin/sec-assignment/edit/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@getEdit',
    'as' => 'security_assignment.edit'
]);

Route::post('/admin/sec-assignment/edit/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@postEdit',
    'as' => 'security_assignment.edit'
]);

Route::get('/admin/sec-assignment/edit/change-staff/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@getChangeStaff',
    'as' => 'security_assignment.change_staff'
]);

Route::post('/admin/sec-assignment/edit/change-staff/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@postChangeStaff',
    'as' => 'security_assignment.change_staff'
]);

Route::get('/admin/sec-assignment/delete/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@getDelete',
    'as' => 'security_assignment.delete'
]);

Route::post('/admin/sec-assignment/delete/{id}', [
    'uses' => 'Auth\AdminSecurityAssignmentController@postDelete',
    'as' => 'security_assignment.delete'
]);




/*Service Assignment Part*/
Route::prefix('admin')->group(function (){
    Route::get('ser-assignment', [
        'uses' => 'Auth\AdminServiceAssignmentController@getIndex',
        'as' => 'admin.service.index'
    ]);

    Route::get('ser-assignment/result', [
        'uses' => 'Auth\AdminServiceAssignmentController@search',
        'as' => 'admin.service.search'
    ]);

    Route::get('ser-assignment/view/{id}', [
        'uses' => 'Auth\AdminServiceAssignmentController@view',
        'as' => 'admin.service.view'
    ]);

    Route::get('ser-assignment/create', [
        'uses' => 'Auth\AdminServiceAssignmentController@getCreate',
        'as' => 'admin.service.create'
    ]);

    Route::post('ser-assignment/create', [
        'uses' => 'Auth\AdminServiceAssignmentController@postCreate',
        'as' => 'admin.service.create'
    ]);

    Route::get('ser-assignment/delete/{id}', [
        'uses' => 'Auth\AdminServiceAssignmentController@getDelete',
        'as' => 'admin.service.delete'
    ]);

    Route::post('ser-assignment/delete/{id}', [
        'uses' => 'Auth\AdminServiceAssignmentController@postDelete',
        'as' => 'admin.service.delete'
    ]);
});

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

Route::get('/client/logout', [
    'uses' => 'Auth\AdminClientController@logout',
    'as' => 'client.logout'
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

//Roster calendar route.
  //Open the roster page route.
Route::get('admin/staff/roster{id}', [
    'uses' => 'Auth\AdminStaffController@getCalendar',
    'as' => 'staff.roster'
]);

  //Save the new roster route.
Route::post('admin/staff/roster{id}', [
    'uses' => 'Auth\AdminStaffController@saveRoster',
    'as' => 'staff.roster'
]);

  //Edit roster route.
Route::post('admin/staff/roster/edit', [
    'uses' => 'Auth\AdminStaffController@uRoster',
    'as' => 'staff.uRoster'
]);

  //Delete roster route.
Route::post('admin/staff/roster/delete', [
    'uses' => 'Auth\AdminStaffController@dRoster',
    'as' => 'staff.dRoster'
]);

//Leave Requests
Route::get('/admin/staff/viewleave',[
    'uses' => 'Auth\AdminStaffController@getLeaveRequests',
    'as' => "staff.getLeaveRequests"
]);
//Accept Leave request
Route::get('admin/staff/leave/accept{id}', [
    'uses' => 'Auth\AdminStaffController@acceptLeave',
    'as' => 'staff.acceptLeave'
]);
//Decline Leave request
Route::get('admin/staff/leave/decline{id}', [
    'uses' => 'Auth\AdminStaffController@declineLeave',
    'as' => 'staff.declineLeave'
]);
//Open delete leave page
Route::get('admin/staff/leave/getdelete{id}', [
    'uses' => 'Auth\AdminStaffController@getLeaveDelete',
    'as' => 'staff.getLeaveDelete'
]);

//delete leave request
Route::post('admin/staff/leave/delete', [
    'uses' => 'Auth\AdminStaffController@postLeaveDelete',
    'as' => 'staff.postLeaveDelete'
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
