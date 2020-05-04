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

    public function getIndex() {
        $sps = service_provider::all();
        return view('Administration.serviceProvider.index', ['sps' => $sps]);
    }

    public function getSearch(Request $request) {
        $search = $request->input('search');
        $sps = service_provider::where('firstname', 'like', '%'.$search.'%')
            ->orWhere('lastname', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')
            ->paginate(5);
        $sps->appends(['search' => $search]);
        return view('Administration.serviceProvider.index', ['sps' => $sps]);
    }

    public function getCreate() {
        return view('Administration.serviceProvider.sp_create');
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email|max:50|unique:serviceproviders',
            'uName'=>'required|max:50',
            'pNumber'=>'required|max:20',
            'password' => 'required|confirmed|max:20'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $serviceProvider = new service_provider([
            'firstname' => $request->input('fName'),
            'lastname' => $request->input('lName'),
            'email' => $request->input('email'),
            'username' => $request->input('uName'),
            'phone_number' => $request->input('pNumber'),
            'password'=> $request->input('password')
        ]);
        $serviceProvider->save();
        return redirect()->route('sp.index');
    }

    public function getEdit($id) {
        $sp = service_provider::find($id);
        return view('Administration.serviceProvider.sp_edit', ['sp' => $sp]);
    }

    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email',
            'pNumber'=>'required|max:10',
        ]);
        if($validator->fails()) {
            return redirect()->route('sp.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $sp = service_provider::find($id);
        $sp->firstname = $request->input('fName');
        $sp->lastname = $request->input('lName');
        $sp->email = $request->input('email');
        $sp->phone_number = $request->input('pNumber');
        $sp->save();
        return redirect()->route('sp.index');
    }

    public function getDelete($id) {
        $sp = service_provider::find($id);
        return view('Administration.serviceProvider.sp_delete', ['sp' => $sp]);
    }


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

    public function postDelete($id) {
        $sp = service_provider::find($id);
        $sp->delete();
        return redirect()->route('sp.index');
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
