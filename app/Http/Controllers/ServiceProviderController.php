<?php

namespace App\Http\Controllers;

use App\applications;
use App\quote;
use App\Service_Feedback;
use App\service_provider;
use App\Service_Provider_Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\Promise\all;

class ServiceProviderController extends Controller
{

   // public function __construct()
    //{
     //   $this->middleware('guest:service_provider');
    //}

    public function getIndex() {
        $jobs = Service_Provider_Job::where('service_provider_id', '=', auth()->guard('service_provider')->id())->get();
        $onGoing = 0;
        $completed = 0;
        $quotes = quote::where('service_provider_id', '=', auth()->guard('service_provider')->id())->count();
        foreach ($jobs as $job){
            if($job->application->status == 2 or $job->application->status == 3) {
                $onGoing += 1;
            }elseif ($job->application->status == 4) {
                $completed += 1;
            }
        }
        return view('Service.index', ['onGoing' => $onGoing, 'completed' => $completed, 'quotes' => $quotes]);

    }

    //Login function.
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
            $email = $request->get('email');
        // attempt login
        if(Auth::guard('service_provider')->attempt($user_data))
            {

                $user = service_provider::query()->where('email',$email)->first();
                $request->session()->put('user',$user);
                $request->session()->put('type', 'service');
                $request->session()->put('guardString', 'service_provider');
                //Session::put('user',$user);
                //if success redirect to profile
                return redirect()->route('service.home') ;

            }

        //if unsuccessful redirect back to login
        else{
            return back()->with('error','Wrong Login Details');
        }
    }

    //Logout function.
    public function serviceLogout(){
        Auth::guard('service_provider')->logout();
        Session::flush();
        return redirect('/');
    }

    //View current accepted jobs.
    public function getJobs(){
        $id = auth()->guard('service_provider')->id();
        $jobs = Service_Provider_Job::where ('service_provider_id', '=', $id)->get();
        return view('Service.jobs', ['jobs' => $jobs]);
    }

    //Accept a job.
    public function acceptJob($id){
        $sp_id = auth()->guard('service_provider')->id();
        $job = new Service_Provider_Job([
                'service_provider_id' => $sp_id,
                'job_id' => $id
            ]
        );
        $job ->save();

        $jobUpdate = applications::query()->where('id',$id)->first();
        $jobUpdate->status= '2';
        $jobUpdate->save();

        $applications = applications::where('status','=','1')->whereNotIn('id', function ($query) {
            $sp_id = auth()->guard('service_provider')->id();
            $query->select('job_id')->where('service_provider_id', '=', $sp_id)->from('quotes');
        })->get();
        return redirect()->route('service.applications', ['applications' => $applications]);
    }

    //Cancel a accepted job.
    public function canceljob($id){
        $job = Service_Provider_Job::find($id);
        $application = applications::find($job->job_id);
        $application->status = 1;
        $application->save();
        $job->delete();
        return redirect()->back();
    }

    //Start job//
    public function startJob($id) {
        $assignment = applications::find($id);
        if($assignment->date == null){
            $assignment->date = date('Y-m-d');
        }
        $assignment->status = 3;
        $assignment->save();
        return redirect()->back();
    }

    public function completeJob(Request $request, $id) {
        $assignment = applications::find($id);
        $assignment->end_date = date('Y-m-d');
        $assignment->status = 4;
        $assignment->save();
        return redirect()->back();

    }

    //View completed jobs//
    public function getCompletedJobs(){
        $id = auth()->guard('service_provider')->id();
        $jobs = Service_Provider_Job::where ('service_provider_id', '=', $id)->get();
        return view('Service.completed_jobs', ['jobs' => $jobs]);
    }


    //Send a quote for a un-priced job.
    public function quote($id, Request $request){
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'hour' => 'required|numeric',
            'message' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors('You must enter the price and message for a quote.')
                ->withInput($request->all());
        }

        $quote = new quote([
            'service_provider_id' => auth()->guard('service_provider')->id(),
            'job_id' => $id,
            'price' => $request->input('price'),
            'estimate_hours' => $request->input('hour'),
            'message' => $request->input('message'),
            'status' => 2,
        ]);
        $quote->save();

        $applications = applications::where('status','=','1')->whereNotIn('id', function ($query) {
            $sp_id = auth()->guard('service_provider')->id();
            $query->select('job_id')->where('service_provider_id', '=', $sp_id)->from('quotes');
        })->get();
        return redirect()->route('service.applications', ['applications' => $applications]);
    }

    //View the current quoted application.
    public function viewQuote() {
        $id = auth()->guard('service_provider')->id();
        $quotes = quote::where('service_provider_id', '=', $id)->get();

        return view('Service.quote_view', ['quotes' => $quotes]);
    }

    public function cancelQuote($id) {
        $quote = quote::find($id);
        $quote->delete();
        return redirect()->back();
    }


    //Update personal detail
    public function getEdit() {
        return view('Service.setting');
    }

    public function postEdit(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone_number'=>'required|max:13|regex:/^(\(02[0-9]{1}\)\-)([0-9]{7})/',
            'street'=>'required|regex:/^[A-Za-z0-9\s?]+$/',
            'suburb'=>'required|regex:/^[A-Za-z\s?]+$/',
            'city'=>'required|regex:/^[A-Za-z\s?]+$/',
            'postcode'=>'required|digits:4'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $service_provider = service_provider::query()->find(Auth::guard('service_provider')->user()->id);
        $service_provider->phone_number = $request->input('phone_number');
        $service_provider->street = $request->input('street');
        $service_provider->suburb = $request->input('suburb');
        $service_provider->city = $request->input('city');
        $service_provider->postcode = $request->input('postcode');
        $service_provider->save();
        return redirect()->back()->with('message', 'Details updated');
    }

    //Change password
    public function changePasswordForm() {
        return view('Service.change_password');
    }

    public function changePassword(Request $request) {
        if(!(Hash::check($request->input('current_password'), Auth::guard('service_provider')->user()->getAuthPassword()))) {
            return back()->withErrors('The current password of your account does not match with what you provided.');
        }

        if(strcmp($request->input('current_password'), $request->input('new_password')) == 0) {
            return back()->withErrors('The new password can not be the same as the current password.');
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::guard('service_provider')->user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return back()->with('message', 'Password change successfully');
    }

    public function postFeedback(Request $request){
        $validator = Validator::make($request->all(), [
            'star' => 'required|numeric|max:5|min:1',
            'message' => 'required|max:300',
            'service_provider_job_id' => 'required|numeric|exists:App\Service_Provider_Job,id'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $service_provider_job = Service_Provider_Job::query()->find($request->input('service_provider_job_id'));
        $client = $service_provider_job->application->client;

        $clientFeedback = new Service_Feedback([
            'rating' => $request->get('star'),
            'message'=> $request->get('message'),
            'service__provider__job_id'=> $request->get('service_provider_job_id'),
            'service_provider_id' => auth()->guard('service_provider')->user()->id,
            'client_id' => $client->id
        ]);
        $clientFeedback->save();
        return redirect()->back()->with('message', 'Feedback Posted');
    }

    public function getImageUpload(){
        return view("Service.upload_image");
    }

    public function postImageUpload(){

        $userId = Auth::guard('service_provider')->user()->id;
        $user = service_provider::query()->find($userId);

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);



        $imageName = time().'.'.request()->image->getClientOriginalExtension();




        request()->image->move(public_path('images'), $imageName);
        $user->imgPath = 'images/' . $imageName;
        $user->save();

        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName);

    }

}
