<?php

namespace App\Http\Controllers;

use App\applications;
use App\quote;
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
                return view('Service.index',['user'=>$user]) ;

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
        $application->status = '1';
        $application->save();
        $job->delete();
        $sp_id = auth()->guard('service_provider')->id();
        $jobs = Service_Provider_Job::where('service_provider_id', '=', $sp_id)->get();
        return redirect()->route('service.jobs', ['jobs' => $jobs]);
    }


    //Send a quote for a un-priced job.
    public function quote($id, Request $request){
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'message' => 'required',
            'hours' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors('You must enter the price, estimate hours and message for a quote.')
                ->withInput($request->all());
        }

        $quote = new quote([
            'service_provider_id' => auth()->guard('service_provider')->id(),
            'job_id' => $id,
            'price' => $request->input('price'),
            'message' => $request->input('message'),
            'quote_type' => $request->input('type'),
            'estimate_hours' => $request->input('hours')
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
}
