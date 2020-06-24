<?php

namespace App\Http\Controllers;

use App\applications;
use App\quote;
use App\Service_Provider_Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function Sodium\add;

class ApplicationsController extends Controller
{
    //Get the applications page.
    public function getApps(){
        $applications = applications::where('status','=','1')->whereNotIn('id', function ($query) {
            $sp_id = auth()->guard('service_provider')->id();
            $query->select('job_id')->where('service_provider_id', '=', $sp_id)->from('quotes');
        })->paginate(5);

        return view('Service.applications',['applications' => $applications]);
    }
}
