<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Staff;
use Illuminate\Http\Request;
use App\applications;

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
        $record = $assignment->service_provider_job;
        return view('Administration.service_Assignment.ser_view', ['assignment' => $assignment, 'record' => $record]);
    }
}
