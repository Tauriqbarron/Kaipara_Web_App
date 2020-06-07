<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\service_provider;

class AdminSpController extends Controller
{
    public function getIndex() {
        $sps = service_provider::all();
        return view('Administration.serviceProvider.index', ['sps' => $sps]);
    }

    public function getSearch(Request $request) {
        $search = $request->input('search');
        $sps = service_provider::where('firstname', 'like', '%'.$search.'%')
            ->orWhere('lastname', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')
            ->paginate(5);
        $sps->appends(['search' => $search]);
        return view('Administration.serviceProvider.index', ['sps' => $sps]);
    }

    public function getCreate() {
        return view('Administration.serviceProvider.sp_create');
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email|max:50|unique:service_providers',
            'uName'=>'required|max:50',
            'pNumber'=>'required|max:20',
            'password' => 'required|confirmed|max:20',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            //'country'=>'required',
            'postcode'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $serviceProvider = new service_provider([
            'firstname' => $request->input('fName'),
            'lastname' => $request->input('lName'),
            'email' => $request->input('email'),
            'username' => $request->input('uName'),
            'phone_number' => $request->input('pNumber'),
            'password'=> Hash::make($request->input('password')),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode')
        ]);
        $serviceProvider->save();
        return redirect()->route('sp.index');
    }

    public function viewSp($id) {
        $sp = service_provider::find($id);
        return view('Administration.serviceProvider.sp_view', ['sp' => $sp]);
    }

    public function getEdit($id) {
        $sp = service_provider::find($id);
        return view('Administration.serviceProvider.sp_edit', ['sp' => $sp]);
    }

    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'fName'=>'required|max:50',
            'lName'=>'required|max:50',
            'email'=>'required|email',
            'pNumber'=>'required|max:10',
            'street'=>'required',
            'suburb'=>'required',
            'city'=>'required',
            //'country'=>'required',
            'postcode'=>'required'
        ]);
        if($validator->fails()) {
            return redirect()->route('sp.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $sp = service_provider::find($id);
        $sp->firstname = $request->input('fName');
        $sp->lastname = $request->input('lName');
        $sp->email = $request->input('email');
        $sp->phone_number = $request->input('pNumber');
        $sp->street = $request->input('street');
        $sp->suburb = $request->input('suburb');
        $sp->city = $request->input('city');
        //$sp->country = $request->input('country');
        $sp->postcode = $request->input('postcode');
        $sp->save();
        return redirect()->route('sp.index');
    }

    public function getDelete($id) {
        $sp = service_provider::find($id);
        return view('Administration.serviceProvider.sp_delete', ['sp' => $sp]);
    }

    public function postDelete($id) {
        $sp = service_provider::find($id);
        $sp->delete();
        return redirect()->route('sp.index');
    }
}
