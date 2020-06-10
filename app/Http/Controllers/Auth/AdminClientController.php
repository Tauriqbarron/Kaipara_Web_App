<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clients;
use App\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    //admin home page.
    public function adminIndex() {
        return view('Administration.index');
    }

    //client management index page.
    public function getIndex() {
        $clients = Clients::all();
        return view('Administration.Client.index', ['clients' => $clients]);
    }

    //client search function.
    public function search(Request $request) {
        $search = $request->input('search');
        $clients = Clients::where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')
            ->paginate(5);
        $clients->appends(['search' => $search]);
        return view('Administration.Client.index', ['clients' => $clients]);
    }

    //get the create client page.
    public function getCreate() {
        return view('Administration.Client.client_create');
    }

    //save the new client to the database.
    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email|unique:clients',
            'pNumber'=>'required|max:50',
            'password'=>'required|confirmed|min:6',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            'postcode'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->route('client.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $client = new Clients([
            'first_name' => $request->input('fName'),
            'last_name' => $request->input('lName'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('pNumber'),
            'password' => Hash::make($request->input('password')),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode')
        ]);
        $client->save();
        return redirect()->route('client.index');
    }

    //view a client detail.
    public function viewClient($id) {
        $client = Clients::find($id);
        return view('Administration.Client.client_view', ['client' => $client]);
    }

    //get the edit client page.
    public function getEdit($id) {
        $client = Clients::find($id);
        return view('Administration.Client.client_edit', ['client' => $client]);
    }

    //update the client.
    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email',
            'pNumber'=>'required|max:50',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            //'country'=>'required',
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
        $client->street = $request->input('street');
        $client->suburb = $request->input('suburb');
        $client->city = $request->input('city');
        //$client->country = $request->input('country');
        $client->postcode = $request->input('postcode');
        $client->save();

        return redirect()->route('client.index');
    }

    //get the delete client page.
    public function getDelete($id) {
        $client = Clients::find($id);
        return view('Administration.Client.client_delete', ['client' => $client]);
    }

    //delete the client from the database.
    public function postDelete($id) {
        $client = Clients::find($id);
        $client->Delete();
        return redirect()->route('client.index');
    }

    //client logout function.
    public function logout() {
        Auth::guard('clients')->logout();
        Session::flush();
        if(!(Auth::guard('clients')->check())){
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Logout failed');
    }
}
