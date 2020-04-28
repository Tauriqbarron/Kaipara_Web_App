<?php

namespace App\Http\Controllers;

use App\service_provider;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{



    public function getprofileIndex()
    {
        $user = service_provider::query()->where('email',$email)->first();
        return view('Service.index');
    }


}
