@extends('Client.layout')
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.security')}}">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="#">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
@section('mainContent')
<div class="row">
    <div class="col-4">
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
        <div class="container jumbotron p-3">
            <div class="row text-center">
                <h5 class="w-100 text-center">Your Security Bookings</h5>
            </div>
            @foreach($bookings as $booking)
                <div class="row bg-white shadow">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                Date:
                            </div>
                            <div class="col">
                                {{$booking->date}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Booking Type:
                            </div>
                            <div class="col">
                                {{$booking->booking_type->description}}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                Start Time:
                            </div>
                            <div class="col">
                                {{$booking->start_time}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Finish Time:
                            </div>
                            <div class="col">
                                {{$booking->finish_time}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container jumbotron p-3">
            <div class="row text-center">
                <h5 class="w-100 text-center">Your Service Applications</h5>
            </div>
            @foreach($applications as $booking)
                <div class="row bg-white shadow">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                Date:
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Booking Type:
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                Start Time:
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Finish Time:
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
