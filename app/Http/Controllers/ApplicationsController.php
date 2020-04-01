<?php

namespace App\Http\Controllers;

use App\applications;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function getApps(){
        $applications = applications::all();
        return view('Service.applications',['applications' => $applications]);
    }
}
