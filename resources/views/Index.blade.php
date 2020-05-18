@extends('layout')

@section('title','Home')

@section('mainContent')
    <div class="container">
        <div class="service-container">
            <img src="{{url('images/event_placeholder.jpg')}}" class="service-img rounded-circle float-left">
            <div class="service-caption-left">
                <h3> Event Security</h3>
                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</h6>
            </div>
        </div>
        <div class="service-container">
            <img src="{{url('images/emergency_placeholder.jpg')}}" class="service-img rounded-circle float-right">
            <div class="service-caption-right">
                <h3>Emergency Security</h3>
                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</h6>
            </div>
        </div>
        <div class="service-container">
            <img src="{{url('images/static_placeholder.jpg')}}" class="service-img rounded-circle float-left">
            <div class="service-caption-left">
                <h3>Static Guards</h3>
                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</h6>
            </div>
        </div>
        <div class="service-container">
            <img src="{{url('images/mobile_placeholder.jpg')}}" class="service-img rounded-circle float-right">
            <div class="service-caption-right">
                <h3>Mobile Guards</h3>
                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</h6>
            </div>
        </div>

    </div>
@endsection
