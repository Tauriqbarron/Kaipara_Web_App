@extends('Administration.layout')

@section('mainContent')

    <div class="container-fluid jumbotron bg-white">
        <h3>Delete Leave Request</h3>
        <div class="row">
            <div class="col-3">
                Subject
            </div>
            <div class="col-9">
                {{$leave->subject}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Message
            </div>
            <div class="col-9">
                {{$leave->message}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Absence Type
            </div>
            <div class="col-9">
                {{$leave->absence_types->description}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Start Date
            </div>
            <div class="col-9">
                {{$leave->start_date}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                End Date
            </div>
            <div class="col-9">
                {{$leave->end_date}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Status
            </div>
            <div class="col-9">
                {{$leave->absence_status->description}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Updated On
            </div>
            <div class="col-9">
                {{$leave->updated_on}}
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <i>Are you sure you want to delete this record?</i>
            </div>

                <div class="col-5">
                    <form method="POST" action="{{route('staff.postLeaveDelete')}}">
                        <a class="btn btn-secondary" href="{{route('staff.getLeaveRequests')}}"> Cancel</a>

                        @csrf
                        <input type="hidden" value="{{$leave->id}}" name="id">
                        <input type="submit" class="btn btn-warning" value="Delete">


                    </form>
                </div>

        </div>

    </div>


@endsection
