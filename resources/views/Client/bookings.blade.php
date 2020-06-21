
@extends('Client.layout')
@section('nav')
    <a href="{{route('client.dashboard')}}" id="profileBtn"><img  src="{{url('images/Dashboard_active.png')}}" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 " id="collapsingNavbar3">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{route('client.security')}}" >Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.property')}}">Property Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.jobs')}}">Service Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('client.bookings')}}">Security Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.quotes')}}">Quotes</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.settings')}}">Settings</a>
            </li>
        </ul>
    </div>
@endsection
@section('mainContent')

    <div class="row">
        <div class="container ml-4">
            <div class="row">
                <div class="col">
                    <h5 class="w-100 text-center">Your Security Bookings</h5>
                    <div class="container jumbotron p-3">
                        <div class="row text-center px-2">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 text-right">
                                        <a class="" href="{{route('client.bookings')}}">{{isset($filtered) ? 'Show All' : ''}}</a>
                                    </div>
                                    <div class="col-8">
                                        <select id="filter" class="form-control" onchange="window.location.href = this.options[selectedIndex].value">
                                            <option class="text-secondary" disabled selected hidden>Filter Results</option>
                                            <option value="{{route('client.getAvailableBookings')}}">Available</option>
                                            <option value="{{route('client.getAssignedBookings')}}">Assigned</option>
                                            <option value="{{route('client.getCompletedBookings')}}">Completed</option>
                                            <option value="{{route('client.getOlderBookings')}}">Older Bookings</option>
                                            <option value="{{route('client.getNewerBookings')}}">Newer Bookings</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($bookings as $booking)

                            <div class="row bg-light shadow m-2 p-2">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-2">
                                            {{\Carbon\Carbon::parse(substr('00:00', 0, (-(strlen(number_format($booking->start_time ,2 , ':','')))) ) . number_format($booking->start_time ,2 , ':',''))->isoFormat('LT')}}
                                        </div>
                                        <div class="col-4">
                                            {{\Carbon\Carbon::parse($booking->date)->isoFormat('dddd Do MMM')}} - {{\Carbon\Carbon::parse($booking->end_date)->isoFormat('dddd Do MMM')}}
                                        </div>
                                        <div class="col-5 text-capitalize text-{{$booking->status == 'available' ? 'success': 'danger'}}">
                                            Status: {{$booking->status}}
                                        </div>
                                        <div class="col-1 btn-group-toggle  toggle-btn">
                                            <input type="radio" class="" id="btnb{{$booking->id}}" data-toggle="collapse" data-target="#b{{$booking->id}}" aria-errormessage="false" aria-controls="b{{$booking->id}}">
                                            <label class="rounded bg-secondary text-center" for="btnb{{$booking->id}}"></label>
                                        </div>
                                    </div>
                                    {{--Booking Info--}}
                                    <div class="row bg-white collapse p-3  shadow-sm" id="b{{$booking->id}}">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <h5>{{$booking->booking_type->description}} on {{\Carbon\Carbon::parse($booking->date)->isoFormat('dddd Do MMM')}}</h5>
                                                </div>

                                            </div>
                                            <div class="row mb-3">
                                                <div class="col text-center text-secondary">
                                                    <em>{{$booking->description}}</em>
                                                </div>
                                            </div>
                                            <div class="row pl-2">
                                                <div class="col-2 text-right">
                                                    <strong>Time</strong>
                                                </div>
                                                <div class="col-4">
                                                    {{\Carbon\Carbon::parse(substr('00:00', 0, (-(strlen(number_format($booking->start_time ,2 , ':','')))) ) . number_format($booking->start_time ,2 , ':',''))->isoFormat('LT')}} -
                                                    {{\Carbon\Carbon::parse(substr('00:00', 0, (-(strlen(number_format($booking->finish_time ,2 , ':','')))) ) . number_format($booking->finish_time ,2 , ':',''))->isoFormat('LT')}}
                                                </div>
                                                <div class="col-3 text-right">
                                                    <strong>Staff Required</strong>
                                                </div>
                                                <div class="col-3">
                                                    {{$booking->staff_needed}}
                                                </div>
                                            </div>
                                            <div class="row pl-2">
                                                <div class="col-2 text-right">
                                                    <strong>Date</strong>
                                                </div>
                                                <div class="col-4">
                                                    {{\Carbon\Carbon::parse($booking->date)->isoFormat('dddd Do MMM')}} - {{\Carbon\Carbon::parse($booking->end_date)->isoFormat('dddd Do MMM')}}
                                                </div>
                                                <div class="col-3 text-right">
                                                    <strong>Staff Assigned</strong>
                                                </div>
                                                <div class="col-3">
                                                    {{$booking->staff_needed - $booking->available_slots}}
                                                </div>
                                            </div>
                                            <div class="row pl-2">
                                                <div class="col-2 text-right">
                                                    <strong>Address</strong>
                                                </div>
                                                <div class="col-4">
                                                    {{$booking->street}}<br>{{$booking->suburb}}<br>{{$booking->city}}, {{$booking->postcode}}
                                                </div>
                                                <div class="col-3 text-right">
                                                    <strong>Status</strong>
                                                </div>
                                                <div class="col-3 text-capitalize text-{{$booking->status == 'available' ? 'success': 'danger'}}">
                                                    <em>{{$booking->status}}</em>
                                                </div>
                                            </div>
                                            @if($booking->status != 'available')
                                                @foreach($booking->staff_assignments as $staff_assignment)
                                                    <div class="modal" id="f{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="modalTestLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form  method="POST" action="{{route('client.postFeedback')}}">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="modal-client-image">
                                                                            <img src="{{url('images/Profile_Placeholder_Large.jpg')}}" class="rounded-circle w-100" alt="Client Image" >
                                                                        </div>
                                                                        <div style="width: 300px; float: right">
                                                                            <h5 class="modal-title" id="modalTestLabel">{{$booking->description}}</h5>
                                                                            <h5 class="modal-title" id="modalTestLabel">Client: {{$booking->client->first_name}} {{$booking->client->last_name}}</h5>
                                                                            <label for="staff_assignment_id">Staff Assignment ID: {{$staff_assignment->id}} </label><input id="staff_assignment_id" name="staff_assignment_id" value="{{$staff_assignment->id}}" type="hidden">
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <label for="rating">Rating:</label>
                                                                        </div>
                                                                        <div class="rating btn-group form-group" id="rating" role="group">
                                                                            <input type="radio" name="star" id="{{$booking->id}}star5" value="5"><label for="{{$booking->id}}star5"></label>
                                                                            <input type="radio" name="star" id="{{$booking->id}}star4" value="4"><label for="{{$booking->id}}star4"></label>
                                                                            <input type="radio" name="star" id="{{$booking->id}}star3" value="3"><label for="{{$booking->id}}star3"></label>
                                                                            <input type="radio" name="star" id="{{$booking->id}}star2" value="2"><label for="{{$booking->id}}star2"></label>
                                                                            <input type="radio" name="star" id="{{$booking->id}}star1" value="1"><label for="{{$booking->id}}star1"></label>
                                                                        </div>
                                                                        <div>
                                                                            <label for="messageBox">Message:</label>
                                                                        </div>
                                                                        <div>
                                                                            <textarea name="message" class="float-left w-100" id="messageBox" rows="5" maxlength="300"></textarea>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success">Submit Feedback</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col my-1 border-light border-bottom font-weight-bold">
                                                            <img src="{{isset($staff_assignment->staff->imgPath) ? url($staff_assignment->staff->imgPath) : url('images/Profile_Placeholder.png')}}" class="rounded-circle quote-provider-image" alt="profile image">
                                                            {{$staff_assignment->staff->first_name}} {{$staff_assignment->staff->last_name}}
                                                        </div>
                                                        <div class="col text-right">
                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#f{{$booking->id}}" {{($booking->status == 'complete' && !(count($staff_assignment->client_feedback) > 0)) ? '' : 'disabled' }}>Feedback</button>
                                                        </div>
                                                    </div>
                                                    @isset($staff_assignment->timesheet)
                                                        <div class="row py-2 border-bottom border-light bg-light">
                                                            <div class="col-2 font-weight-bold">
                                                                Date
                                                            </div>
                                                            <div class="col-6 font-weight-bold">
                                                                Time
                                                            </div>
                                                            <div class="col-4 text-right font-weight-bold">
                                                                Hours
                                                            </div>
                                                        </div>
                                                    @php($total = 0)
                                                        @foreach($staff_assignment->timesheet as $timesheet)
                                                            @if($timesheet->status == 2)
                                                                <div class="row my-2 border-bottom border-light">
                                                                    <div class="col-2">
                                                                        {{Carbon\Carbon::parse($timesheet->date)->isoFormat('dddd Do MMM')}}
                                                                    </div>
                                                                    <div class="col-6">
                                                                        {{Carbon\Carbon::parse($timesheet->start_time)->isoFormat('LT')}} -
                                                                        {{Carbon\Carbon::parse($timesheet->stop_time)->isoFormat('LT')}}
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        {{number_format((floor($timesheet->stop_time) + (($timesheet->stop_time - floor($timesheet->stop_time))/.6)) - (floor($timesheet->start_time) + (($timesheet->start_time - floor($timesheet->start_time))/.6)),2)}}
                                                                        @php($total += (floor($timesheet->stop_time) + (($timesheet->stop_time - floor($timesheet->stop_time))/.6)) - (floor($timesheet->start_time) + (($timesheet->start_time - floor($timesheet->start_time))/.6)))
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <div class="row my-2 border-bottom border-light">
                                                            <div class="col-2">
                                                            </div>
                                                            <div class="col-6">
                                                            </div>
                                                            <div class="col-4 text-right font-weight-bold">
                                                                Total: {{number_format($total,2)}}
                                                            </div>
                                                        </div>
                                                    @endisset
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
