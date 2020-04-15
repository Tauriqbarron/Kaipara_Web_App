<?php

namespace App\Http\Controllers;

use App\serviceprovider;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    public function getIndex() {
        $serviceProviders = serviceprovider::all();
        return view('Administration.serviceProvider.index', ['serviceProviders' => $serviceProviders]);
    }
}
