@extends('Administration.layout')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@section('mainContent')
    @foreach(\App\Leave_Request::all() as $leave)
        <div class="modal" id="l{{$leave->id}}" tabindex="-1" role="dialog" aria-labelledby="modalTestLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                @csrf
                <div class="modal-content">
                    <div class="modal-header container">
                        <div class="row">
                            <div class="modal-client-image col-4">
                                <img src="{{url($leave->staff->imgPath)}}" class="rounded-circle border border-white shadow" style="width: 110px; height: 110px; object-fit: cover" alt="Client Image" >
                            </div>
                            <div style="width: 300px; float: right" class="col-8">
                                <div class="row">
                                    <h5 class="modal-title" id="modalTestLabel">{{$leave->subject}}</h5>
                                </div>
                                <div class="row">
                                    <div class="modal-title" id="modalTestLabel">Sender: {{$leave->staff->first_name}} {{$leave->staff->last_name}}</div>
                                </div>
                                <div class="row">
                                    <div class="pl-0 modal-title col">Staff ID: {{$leave->staff->id}}</div>
                                    <div class="modal-title col"> <a href="{{route('staff.roster', ['id' => $leave->staff->id])}}" class="font-italic">View Roster</a></div>
                                </div>
                                <div class="row">
                                    <div class=" w-100">Leave Type: {{$leave->absence_types->description}}</div>
                                </div>

                            </div>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body container">
                        <div class="row mx-3 my-2" >
                                <textarea class="form-control" style="resize: none" rows="5" readonly>{{$leave->message}}</textarea>
                        </div>
                        <div class="row mx-3 my-2 text-center ">
                            <strong>Dates Requested: </strong> {{\Carbon\Carbon::parse($leave->start_date)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($leave->end_date)->format('d/m/Y')}}
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($leave->absence_status->id === 0)
                        <a class="btn btn-success" href="{{route('staff.acceptLeave', ['id' => $leave->id])}}">Approve</a>
                        <a class="btn btn-danger" href="{{route('staff.declineLeave', ['id' => $leave->id])}}">Decline</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container-fluid jumbotron bg-white">
        <h1>Pending Leave Requests</h1>

        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Leave Type</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Leave_Request::query()->where('absence_status_id', '=', 1)->get() as $leave)
                    <tr>
                        <td>{{$leave->subject}}</td>
                        <td>{{$leave->absence_types->description}}</td>
                        <td>{{$leave->start_date}}</td>
                        <td>{{$leave->end_date}}</td>
                        <td>{{$leave->staff->first_name}}</td>
                        <td>{{$leave->staff->last_name}}</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#l{{$leave->id}}">View</button></td>
                        <td><a class="btn btn-success" href="{{route('staff.acceptLeave', ['id' => $leave->id])}}">Approve</a></td>
                        <td><a class="btn btn-danger" href="{{route('staff.declineLeave', ['id' => $leave->id])}}">Decline</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>

            <h1>Reviewed Leave Requests</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Leave Type</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Leave_Request::query()->where('absence_status_id', '!=', 1)->get() as $leave)
                    <tr>
                        <td>{{$leave->subject}}</td>
                        <td>{{$leave->absence_types->description}}</td>
                        <td>{{$leave->start_date}}</td>
                        <td>{{$leave->end_date}}</td>
                        <td>{{$leave->staff->first_name}}</td>
                        <td>{{$leave->staff->last_name}}</td>
                        <td>{{$leave->absence_status->description}}</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#l{{$leave->id}}">View</button></td>
                        @if($leave->absence_status->id === 3)
                            <td><a class="btn btn-danger" href="{{route('staff.getLeaveDelete', ['id' => $leave->id])}}">Delete</a></td>
                        @endif
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endsection
