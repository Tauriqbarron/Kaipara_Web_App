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
        $clients = Clients::paginate(10);
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
            'first_name'=>'required|max:50|regex:/[a-zA-Z]/',
            'last_name'=>'required|max:50|regex:/[A-Za-z]/',
            'email'=>'required|email|unique:clients',
            'phone_number1'=>'required|regex:/(02[0-9])/',
            'phone_number2'=>'required|digits_between:7, 10/',
            'password'=>'required|min:6|regex:/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])/|confirmed',
            'street'=>'required|regex:/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])/',
            'suburb'=>'required|regex:/[A-Za-z]/',
            'city'=>'required|regex:/[A-Za-z]/',
            'postcode'=>'required|digits:4'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $client = new Clients([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone_number' => '('.$request->input('phone_number1').')-'.$request->input('phone_number2'),
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
            'first_name'=>'required|max:50|regex:/[A-Za-z]/',
            'last_name'=>'required|max:50|regex:/[A-Za-z]/',
            'phone_number1'=>'required|regex:/(02[0-9])/',
            'phone_number2'=>'required|digits_between:7, 10/',
            'street'=>'required|regex:/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(\s?)/',
            'suburb'=>'required|regex:/[A-Za-z]/',
            'city'=>'required|regex:/[A-Za-z]/',
            'postcode'=>'required|digits:4'
        ]);
        if($validator->fails()) {
            return redirect()->route('client.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $client = Clients::find($id);
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->phone_number = '('.$request->input('phone_number1').')-'.$request->input('phone_number2');
        $client->street = $request->input('street');
        $client->suburb = $request->input('suburb');
        $client->city = $request->input('city');
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
        Auth::guard('client')->logout();
        Session::flush();
        if(!(Auth::guard('client')->check())){
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Logout failed');
    }
}
