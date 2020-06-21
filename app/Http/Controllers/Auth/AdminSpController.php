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
        $sps = service_provider::paginate(10);
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
            'first_name'=>'required|max:50|regex:/^[A-Za-z]+$',
            'last_name'=>'required|max:50|regex:/^[A-Za-z]+$/',
            'email'=>'required|email|max:50|unique:service_providers',
            'uName'=>'required|max:50',
            'phone_number1'=>'required|regex:/(02[0-9])/',
            'phone_number2'=>'required|digits_between:7, 10',
            'password'=>'required|min:8|regex:/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])/|confirmed',
            'street'=>'required|regex:/^[A-Za-z0-9\s?]+$/',
            'suburb'=>'required|regex:/^[A-Za-z\s?]+$/',
            'city'=>'required|regex:/^[A-Za-z\s?]+$/',
            'postcode'=>'required|digits:4'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $serviceProvider = new service_provider([
            'firstname' => $request->input('first_name'),
            'lastname' => $request->input('last_name'),
            'email' => $request->input('email'),
            'username' => $request->input('uName'),
            'phone_number' => '('.$request->input('phone_number1').')-'.$request->input('phone_number2'),
            'password'=> Hash::make($request->input('password')),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode')
        ]);
        $serviceProvider->save();
        return redirect()->route('sp.index')->with('message', 'New service provider created.');
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
            'first_name'=>'required|max:50|regex:/^[A-Za-z]+$/',
            'last_name'=>'required|max:50|regex:/^[A-Za-z]+$/',
            'phone_number1'=>'required|regex:/(02[0-9])/',
            'phone_number2'=>'required|digits_between:7, 10',
            'street'=>'required|regex:/^[A-Za-z0-9\s?]+$/',
            'suburb'=>'required|regex:/^[A-Za-z\s?]+$/',
            'city'=>'required|regex:/^[A-Za-z\s?]+$/',
            'postcode'=>'required|digits:4'
        ]);
        if($validator->fails()) {
            return redirect()->route('sp.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $sp = service_provider::find($id);
        $sp->firstname = $request->input('first_name');
        $sp->lastname = $request->input('last_name');
        $sp->phone_number = '('.$request->input('phone_number1').')-'.$request->input('phone_number2');
        $sp->street = $request->input('street');
        $sp->suburb = $request->input('suburb');
        $sp->city = $request->input('city');
        //$sp->country = $request->input('country');
        $sp->postcode = $request->input('postcode');
        $sp->save();
        return redirect()->route('sp.index')->with('message', 'Update successfully.');
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
