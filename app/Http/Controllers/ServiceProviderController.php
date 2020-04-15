<?php

namespace App\Http\Controllers;
use App\ServiceProvider;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    public function getIndex() {
        $serviceProviders = ServiceProvider::all();
        return view('Administration.serviceProvider.index', ['serviceProviders' => $serviceProviders]);
    }
}
