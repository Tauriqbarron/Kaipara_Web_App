<?php

namespace App\Http\Controllers\Auth;

use App\Clients;
use App\Http\Controllers\Controller;
use App\Job_Type;
use App\Service_Provider_Job;
use App\Staff;
use Illuminate\Http\Request;
use App\applications;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class AdminServiceAssignmentController extends Controller
{
    public function getIndex() {
        $assignments = applications::paginate(10);
        return view('Administration.service_Assignment.index', ['assignments' => $assignments]);
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $assignments = applications::where('id', 'like', '%'.$search.'%')
            ->orWhere('client_id', 'like', '%'.$search.'%')
            ->paginate(10);
        $assignments->appends(['search' => $search]);
        return view('Administration.service_Assignment.index', ['assignments' => $assignments]);
    }

    public function view($id) {
        $assignment = applications::find($id);
        return view('Administration.service_Assignment.ser_view', ['assignment' => $assignment]);
    }

    public function getCreate() {
        $types = Job_Type::all();
        return view('Administration.service_Assignment.ser_create', ['types' => $types]);
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|numeric',
            'title' => 'required|regex:/[A-Za-z0-9\-?]/',
            'job_type' => 'required',
            'price' => 'numeric',
            'description' => 'required',
            'date' => 'required|date|after:today',
            'street'=>'required|regex:/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(\s?)/',
            'suburb'=>'required|regex:/^[A-Za-z]+$/',
            'city'=>'required|regex:/^[A-Za-z]+$/',
            'postcode'=>'required|digits:4',
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if(!Clients::where('id', '=', $request->input('client_id'))->exists()) {
            return redirect()->back()->with('message', 'The client does not exist.')->withInput($request->all());
        }

        $assignment = new applications([
            'client_id' => $request->input('client_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'date' => $request->input('date'),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postCode' => $request->input('postcode'),
            'status' => 1,
            'job__type_id' => $request->input('job_type')
        ]);
        $assignment->save();
        return redirect()->route('admin.service.index')->with('message', 'New security assignment created.');

    }

    //Update property service assignment//
    public function getEdit($id) {
        $assignment = applications::find($id);
        $types = Job_Type::all();
        return view('Administration.service_Assignment.ser_edit', ['assignment' => $assignment, 'types' => $types]);
    }

    public function postEdit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/[A-Za-z0-9\-?]/',
            'job_type' => 'required',
            'price' => 'numeric',
            'description' => 'required',
            'date' => 'required|date|after:today',
            'street'=>'required|regex:/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(\s?)/',
            'suburb'=>'required|regex:/^[A-Za-z]+$/',
            'city'=>'required|regex:/^[A-Za-z]+$/',
            'postcode'=>'required|digits:4',
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $assignment = applications::find($id);
        $assignment->title = $request->input('title');
        $assignment->job__type_id = $request->input('job_type');
        $assignment->price = $request->input('price');
        $assignment->description = $request->input('description');
        $assignment->date = $request->input('date');
        $assignment->end_date = $request->input('end_date');
        $assignment->street = $request->input('street');
        $assignment->suburb = $request->input('suburb');
        $assignment->city = $request->input('city');
        $assignment->postCode = $request->input('postcode');
        $assignment->save();

        return redirect()->route('admin.service.index')->with('message', 'Update successfully.');

    }


    //Delete property service assignment//
    public function getDelete($id) {
        $assignment = applications::find($id);
        return view('Administration.service_Assignment.ser_delete', ['assignment' => $assignment]);
    }

    public function postDelete($id) {
        $assignment = applications::find($id);
        if(Service_Provider_Job::where('job_id', '=', $id)->exists()){
            return redirect()->back()->withErrors('You can not delete a processing assignment.');
        }else{
            $assignment->delete();
            return redirect()->route('admin.service.index');
        }


    }
}
