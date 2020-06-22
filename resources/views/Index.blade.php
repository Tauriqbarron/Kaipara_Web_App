@extends('layout')

@section('title','Home')

@section('title2','Our Security Services')

@section('security', 'active')

@section('mainContent')
    <div class="container">
        <div class="service-container container">
            <div class="row">
                <div class="col-3">
                    <img src="{{url('images/event_placeholder_v.jpg')}}" class="service-img rounded-circle float-left">
                </div>
                <div class="col-6 text-center pt-4">
                    <h3> Event Security</h3>
                    <h6>We provide security for all occasions, including indoor and outdoor concerts, festivals, sporting games, automotive auctions and corporate parties</h6>
                </div>
            </div>
        </div>
        <div class="service-container container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 text-center pt-4">
                    <h3>Static Guards</h3>
                    <h6>We have guards on hand to protect the things most valuable to you. We can ensure your home and possessions stay safe while you are away</h6>
                </div>
                <div class="col-3">
                    <img src="{{url('images/static_placeholder_v.jpg')}}" class="service-img rounded-circle float-left">
                </div>
            </div>
        </div>
        <div class="service-container container">
            <div class="row">
                <div class="col-3">
                    <img src="{{url('images/mobile_placeholder.jpg')}}" class="service-img rounded-circle float-left">
                </div>
                <div class="col-6 text-center pt-4">
                    <h3> Mobile Security</h3>
                    <h6>Our mobile patrol security guards secure premises and personnel by patrolling property; monitoring surveillance equipment; and inspecting edifices, equipment, and access points </h6>
                </div>
            </div>
        </div>
    </div>
@endsection
