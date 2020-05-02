<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clients;
use App\Address;
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

    public function getEdit($id) {
        $client = Clients::find($id);
        return view('Administration.Client.client_edit', ['client' => $client]);
    }

    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email',
            'pNumber'=>'required|max:50',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            'country'=>'required',
            'postcode'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->route('client.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $client = Clients::find($id);
        $client->first_name = $request->input('fName');
        $client->last_name = $request->input('lName');
        $client->email = $request->input('email');
        $client->phone_number = $request->input('pNumber');
        $client->save();

        $address = Address::find($client->address_id);
        $address->street = $request->input('street');
        $address->suburb = $request->input('suburb');
        $address->city = $request->input('city');
        $address->country = $request->input('country');
        $address->postcode = $request->input('postcode');
        $address->save();
        return redirect()->route('client.index');
    }
}
