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

    //Accept a job.
    public function acceptJob($id){
        $sp_id = auth()->guard('service_provider')->id();
        //$user = Session::has('user') ? Session::get('user'): null;
        $job = new Service_Provider_Job([
                'service_provider_id' => $sp_id,
                'job_id' => $id
            ]
        );
        $job ->save();

        $jobUpdate = applications::query()->where('id',$id)->first();
        $jobUpdate->status= '2';
        $jobUpdate->save();

        $applications = applications::query()->select('*')->where('status','=','1')->get();
        return view('Service.applications',['applications' => $applications]);
    }

    //View current accepted jobs.
    public function getJobs(){
        //$user = Session::has('user') ? Session::get('user'): null;
        //$userID = $user->id;
        //$jobs = applications::query()
        //->join('service__provider__jobs','applications.id','=','service__provider__jobs.job_id')
        //->select('applications.*')->where('service__provider__jobs.service_provider_id',$userID)->get();
        $id = auth()->guard('service_provider')->id();
        $jobs = Service_Provider_Job::where ('service_provider_id', '=', $id)->get();
        return view('Service.jobs',['jobs'=>$jobs]);
    }

    //Cancel a accepted job.
    public function canceljob($id){
        $user = Session::has('user') ? Session::get('user'): null;
        $userID = $user->id;
        $jobupdate = applications::query()->select('*')->where('id',$id)->first();
        $jobupdate->status='1';
        $jobupdate->save();
        Service_Provider_Job::query()->where('job_id',$id)->delete();
        $jobs = applications::query()
            ->join('service__provider__jobs','applications.id','=','service__provider__jobs.job_id')
            ->select('applications.*')->where('service__provider__jobs.service_provider_id',$userID)->get();
        return view('Service.jobs',['jobs'=>$jobs],['user'=>$user]);
    }


    //Send a quote for a un-priced job.
    public function quote($id,Request $request){
        //$user = Session::has('user') ? Session::get('user'): null;

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
            'estimate_hour' => $request->input('hours')
        ]);
        $quote->save();

        $jobUpdate = applications::query()->where('id',$id)->first();
        $jobUpdate->status= '2';
        $jobUpdate->save();

        $applications = applications::query()->select('*')->where('status','=','1')->get();
        return view('Service.applications',['applications' => $applications]);
    }
}
