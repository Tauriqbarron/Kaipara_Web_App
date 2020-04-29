<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Staff_Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(){

    }

    public function Create(){

    }

    public function CreatePost(Request $request){

    }

    public function getStaffAssignments(int $staffId){
        $r = [];
        $staffAssignments = Staff_Assignment::where('staff_id','=',$staffId);
        foreach ($staffAssignments as $sa){
            $assignmentId = $sa->assignment_id;
            $assignment = Assignment::find($assignmentId);
            $r[] = $assignment;
        }
        return $r;
    }

}
