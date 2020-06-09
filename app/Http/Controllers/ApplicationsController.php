<?php

namespace App\Http\Controllers;

use App\applications;
use App\Service_Provider_Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApplicationsController extends Controller
{
    public function getApps(){
        //$user = Session::has('user') ? Session::get('user'): null;
        $applications = applications::query()->select('*')->where('status','=','1')->get();
        //$applications = applications::all();
        return view('Service.applications',['applications' => $applications]);
    }
}
