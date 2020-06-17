<?php

namespace App\Http\Controllers\Auth;

use App\Clients;
use App\Http\Controllers\Controller;
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
        return view('Administration.service_Assignment.ser_create');
    }

    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|numeric',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|after:today',
            'start_time' => 'required|date_format:H:i',
            'finish_time' => 'required|date_format:H:i',
            'street' => 'required',
            'suburb' => 'required',
            'city' => 'required',
            'postcode' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors('Please enter valid data to all blank')
                ->withInput($request->all());
        }

        $client = Clients::where('id', '=', $request->input('client_id'));
        if($client == null) {
            return redirect()->back()->withErrors('The client does not exist.');
        }

        $assignment = new applications([
            'client_id' => $request->input('client_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'date' => $request->input('date'),
            'start_time' => date("H:i:s", strtotime(request('start_time'))),
            'finish_time' => date("H:i:s", strtotime(request('finish_time'))),
            'street' => $request->input('street'),
            'suburb' => $request->input('suburb'),
            'city' => $request->input('city'),
            'postcode' => $request->input('postcode'),
            'status' => 1,
        ]);
        $assignment->save();
        return redirect()->route('admin.service.index');

    }

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
