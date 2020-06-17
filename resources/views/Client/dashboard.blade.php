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
                <a class="nav-link" href="#">Service Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Security Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Quotes</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
            </li>
        </ul>
    </div>
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
    <div class="col-7">
        <div class="container jumbotron p-3">
            <div class="row text-center">
                <h5 class="w-100 text-center">Your Security Bookings</h5>
            </div>
            @foreach($bookings as $booking)
                <div class="row bg-white shadow m-2 p-2">
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
                                {{substr('00:00', 0, (-(strlen(number_format($booking->start_time ,2 , ':','')))) ) . number_format($booking->start_time ,2 , ':','')}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Finish Time:
                            </div>
                            <div class="col">
                                {{substr('00:00', 0, (-(strlen(number_format($booking->finish_time ,2 , ':','')))) ) . number_format($booking->finish_time ,2 , ':','')}}
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
                <div class="row bg-white shadow m-2 p-2">
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
