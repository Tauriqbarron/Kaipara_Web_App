<?php

namespace App\Http\Controllers;

use App\applications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApplicationsController extends Controller
{
    public function getApps(){
        $user = Session::has('user') ? Session::get('user'): null;
        $applications = applications::all();
        return view('Service.applications')->with('applications' , $applications)->with('user',$user);


    }
}
