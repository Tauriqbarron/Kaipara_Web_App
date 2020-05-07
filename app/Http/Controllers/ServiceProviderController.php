<?php

namespace App\Http\Controllers;

use App\applications;
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
                //Session::put('user',$user);
                //if success redirect to profile
                return view('Service.index',['user'=>$user]) ;

            }

        //if unsuccessful redirect back to login
        else{
            return back()->with('error','Wrong Login Details');
        }
    }

    public function acceptJob($id){

        $user = Session::has('user') ? Session::get('user'): null;
        $job = new Service_Provider_Job([
                'service_provider_id' => $user->id,
                'job_id' => $id
            ]
        );
        $job ->save();

        $jobUpdate = applications::query()->where('id',$id)->first();
        $jobUpdate->status= '2';
        $jobUpdate->save();

        $applications = applications::query()->select('*')->where('status','=','1')->get();
        return view('Service.applications',['applications' => $applications, 'user'=>$user]);
    }

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
        return view('Service.Jobs',['jobs'=>$jobs],['user'=>$user]);
    }

    public function getJobs(){
        $user = Session::has('user') ? Session::get('user'): null;
        $userID = $user->id;
        $jobs = applications::query()
            ->join('service__provider__jobs','applications.id','=','service__provider__jobs.job_id')
            ->select('applications.*')->where('service__provider__jobs.service_provider_id',$userID)->get();

       // $jobs = applications::query()->select('*')->whereIn('id', Service_Provider_Job::query()->select('job_id')->where('service_provider_id',$userID)->get())->get();
       // $jobs = applications::all();
        return view('Service.jobs',['jobs'=>$jobs],['user'=>$user]);
    }
}
