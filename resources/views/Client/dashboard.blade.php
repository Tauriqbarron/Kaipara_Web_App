@extends('Client.layout')
@section('nav')
    <img class="page-toggle-btn navbar-brand d-flex mr-auto text-light active" data-target="profileContainer" id="profileBtn" alt="Dashboard" />
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
                <a class="nav-link" href="{{route('client.bookings')}}">Security Bookings</a>
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
    <div class="container ml-3">
        <div class="row">
            <div class="col-4 mt-5">
                <div class="card bg-light w-100 shadow-sm">
                    <div class="card-header">
                        <h5>Jump to:</h5>
                    </div>
                    <div class="card-body container w-100">
                        <a href="#" class="row nav-link">Dashboard</a>
                        <a href="#" class="row nav-link">Book a Security Job</a>
                        <a href="#" class="row nav-link">Book a Property Service</a>
                        <a href="#" class="row nav-link">Your Security Bookings</a>
                        <a href="#" class="row nav-link">Your Service Applications</a>
                        <a href="#" class="row nav-link">Your Quotes</a>
                        <a href="#" class="row nav-link">Your Information</a>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <h4 class="w-100 text-center">Your Security Bookings</h4>
                <div class="container jumbotron p-3">
                    <div class="row text-center">
                    </div>
                    @foreach($bookings as $booking)
                        <div class="row bg-light shadow m-2 p-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col-2">
                                        {{\Carbon\Carbon::parse(substr('00:00', 0, (-(strlen(number_format($booking->start_time ,2 , ':','')))) ) . number_format($booking->start_time ,2 , ':',''))->isoFormat('LT')}}
                                    </div>
                                    <div class="col-4">
                                        {{\Carbon\Carbon::parse($booking->date)->isoFormat('dddd Do MMM')}}
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
                                                <h5>{{$booking->booking_type->description}} on {{\Carbon\Carbon::parse($booking->date)->isoFormat('ddd Do MMM')}}</h5>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h4 class="w-100 text-center">Your Service Jobs</h4>
                <div class="container jumbotron p-3">
                    <div class="row text-center">
                    </div>
                    @foreach($applications as $application)
                        <div class="row bg-light shadow m-2 p-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col-3">
                                        {{isset($application->date) ? \Carbon\Carbon::parse($application->date)->isoFormat('ddd Do MMMM'): 'Date: Pending' }}
                                    </div>
                                    <div class="col-8 text-center">
                                        {{$application->title}}
                                    </div>
                                    <div class="col-1 btn-group-toggle  toggle-btn">
                                        <input type="radio" class="" id="btna{{$application->id}}" data-toggle="collapse" data-target="#a{{$application->id}}" aria-errormessage="false" aria-controls="a{{$application->id}}">
                                        <label class="rounded bg-secondary text-center" for="btna{{$application->id}}"></label>
                                        @if($application->status == 4 && count($application->service_provider_job->client_service_feedback)<1)
                                            <span style="position: absolute; font-size: 6pt; bottom:20px;left: 8px;" title="Post Feedback" class="font-weight-bold rounded-circle badge-danger badge-pill">!</span>
                                        @endif
                                    </div>
                                </div>
                                {{--Application Info--}}
                                <div class="row bg-white collapse p-3  shadow-sm" id="a{{$application->id}}">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h5>{{$application->title}}</h5>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col text-center text-secondary">
                                                <em>{{$application->description}}</em>
                                            </div>
                                        </div>
                                        <div class="row pl-2">
                                            <div class="col-2 text-right">
                                                <strong>Status</strong>
                                            </div>
                                            <div class="col-4 text-{{$application->status == 1 ? 'success': ($application->status == 4 ? 'secondary' : 'danger')}}">
                                                {{$application->status == 1 ? 'Available': ($application->status == 4 ? 'Completed' : "Assigned")}}
                                            </div>
                                            <div class="col-3 text-right">
                                                <strong>Quotes</strong>
                                            </div>
                                            <div class="col-3">
                                                {{count($application->quotes)}}
                                            </div>
                                        </div>
                                        <div class="row pl-2">
                                            <div class="col-2 text-right">
                                                <strong>Address</strong>
                                            </div>
                                            <div class="col-4">
                                                {{$application->street}}<br>{{$application->suburb}}<br>{{$application->city}}, {{$application->postCode}}
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <strong>Price</strong>
                                                    </div>
                                                    <div class="col">
                                                        {{isset($application->price) ? '$' . number_format($application->price, 2) : 'Quote Requested'}}
                                                    </div>
                                                </div>
                                                @if(isset($application->service_provider_job))
                                                    <div class="row">
                                                        <div class="col text-right">
                                                            <strong>Worker</strong>
                                                        </div>
                                                        <div class="col">
                                                            <button class="btn-link border-0 bg-white " data-toggle="modal" data-target="#f{{$application->id}}">{{$application->service_provider_job->service_provider->firstname}} {{$application->service_provider_job->service_provider->lastname }}
                                                                @if($application->status == 4 && count($application->service_provider_job->client_service_feedback)<1)
                                                                    <span style="position: relative; font-size: 6pt; bottom:7px;right: 8px;" title="Post Feedback" class="font-weight-bold rounded-circle badge-danger badge-pill">!</span>
                                                                @endif
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @php($service_provider = $application->service_provider_job->service_provider)
                                                    <div class="modal" id="f{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="modalTestLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="modal-client-image">
                                                                        <img src="{{isset($service_provider->imgPath) ? url($service_provider->imgPath) : url('images/Profile_Placeholder_Large.jpg')}}" class="rounded-circle w-100" alt="Worker Image" >
                                                                    </div>
                                                                    <div style="width: 300px; float: right">
                                                                        <h5 class="modal-title" id="modalTestLabel">{{$service_provider->firstname}} {{$service_provider->lastname}}</h5>
                                                                        <h5 class="modal-title">Score: {{count($service_provider->client_service_feedback)>0 ? $service_provider->client_service_feedback->avg('rating') : 'Pending'}} </h5>
                                                                    </div>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="modal-content container">
                                                                        <div class="row">
                                                                            <div class="col-2 text-right font-weight-bold">
                                                                                Email
                                                                            </div>
                                                                            <div class="col-10">
                                                                                {{$service_provider->email}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-2 text-right font-weight-bold">
                                                                                Phone
                                                                            </div>
                                                                            <div class="col-10">
                                                                                {{$service_provider->phone_number}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="container rounded bg-light mt-3 py-3">
                                                                        @if($application->status == 4 && count($application->service_provider_job->client_service_feedback)<1)
                                                                            <form method="post" class="" action="{{route('client.service.postFeedback')}}">
                                                                                @csrf
                                                                                <h5>Job Feedback</h5>
                                                                                <input type="hidden" name="service_provider_job_id" value="{{$application->service_provider_job->id}}">

                                                                                <label for="rating">Rating:</label>
                                                                                <div class="rating btn-group form-group" id="rating" role="group">
                                                                                    <input type="radio" name="star" id="{{$application->id}}star5" value="5"><label for="{{$application->id}}star5"></label>
                                                                                    <input type="radio" name="star" id="{{$application->id}}star4" value="4"><label for="{{$application->id}}star4"></label>
                                                                                    <input type="radio" name="star" id="{{$application->id}}star3" value="3"><label for="{{$application->id}}star3"></label>
                                                                                    <input type="radio" name="star" id="{{$application->id}}star2" value="2"><label for="{{$application->id}}star2"></label>
                                                                                    <input type="radio" name="star" id="{{$application->id}}star1" value="1"><label for="{{$application->id}}star1"></label>
                                                                                </div>
                                                                                <div>
                                                                                    <label for="messageBox">Message:</label>
                                                                                </div>
                                                                                <div>
                                                                                    <textarea name="message" class="float-left w-100 form-control" id="messageBox" rows="5" maxlength="300"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col text-right">
                                                                                        <input class="btn btn-success mt-2" type="submit" value="Submit Feedback">
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        @endif
                                                                        {{count($application->service_provider_job->client_service_feedback)<1 ? '' : 'Feedback Posted' }}
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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
