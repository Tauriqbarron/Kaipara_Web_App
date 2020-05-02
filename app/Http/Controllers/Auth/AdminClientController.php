<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clients;
use Illuminate\Support\Facades\Validator;

class AdminClientController extends Controller
{
    public function getIndex() {
        $clients = Clients::all();
        return view('Administration.Client.index', ['clients' => $clients]);
    }

    public function viewClient($id) {
        $client = Clients::find($id);
        return view('Administration.Client.client_view', ['client' => $client]);
    }
}
