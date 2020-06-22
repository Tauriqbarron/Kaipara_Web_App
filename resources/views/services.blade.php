@extends('layout')

@section('title','Home')

@section('title2','Our Property Services')

@section('service', 'active')

@section('mainContent')
    <div class="container">
        <div class="service-container container">
            <div class="row">
                <div class="col-3">
                    <img src="{{url('images/Lawn_Mowing_Placeholder.jpg')}}" class="service-img rounded-circle float-left">
                </div>
                <div class="col-6 text-center pt-4">
                    <h3>Property Maintenance</h3>
                    <h6>Our service is designed to connect property owners with the people they need.</h6>
                </div>
            </div>
        </div>

    </div>
@endsection
