@extends('Profile.layout')

@section('mainContent')
    <div class="profile-card-col" style="min-height: 670px">
        <div  class="profile-id-card card bg-light shadow p-3 mb-2 border-0 card-image float-none rounded-lg shadow col-sm-0" style="background-image: url({{url('images/Card_BG.jpg')}}); ">
            <div id="cardHeader" class="card-header bg-light border-0 rounded">
                <img class="w-100 align-top" src="{{url('images/Card_Header.png')}}" alt="Card top">
            </div>
            <img id="card-img-top" class="card-img-top rounded-circle border-light shadow border-3 mr-auto ml-auto mb-auto" src="{{Auth()->guard('service_provider')->user()->image}}" alt="Card image cap">
            <div class="mt-4 card-body text-light">
                <h5 class="card-title text-center">{{Auth()->guard('service_provider')->user()->firstname}} {{Auth()->guard('service_provider')->user()->lastname}}</h5>
                <h5 class="card-title text-center">Ph: {{Auth()->guard('service_provider')->user()->phone_number}}</h5>
                <h5 class="card-title text-center">ID#: {{Auth()->guard('service_provider')->user()->id}}</h5>

            </div>

            <div class="card-footer bg-dark rounded">
                <img class="w-100 align-top" src="{{url('images/KaiparaLogo.png')}}" alt="Card top">
            </div>
        </div>
    </div>

    <h2 class="text-center">Current Jobs Overview </h2>
    <div class="container py-3 px-4 jumbotron bg-light" id="schedule" style="width:74%; float: left; padding-left: 20px">
        <strong class="text-primary" style="font-size: 35px">Ongoing Jobs: {{$onGoing}}</strong> <a class="float-right" href="{{route('service.jobs')}}"><i class="fas fa-arrow-circle-right fa-3x"></i></a>
        <br/>
        <hr/>
        <br/>

        <strong class="text-success" style="font-size: 35px">Completed Jobs: {{$completed}}</strong> <a class="float-right" href="{{route('service.completed_jobs')}}"><i class="fas fa-arrow-circle-right fa-3x"></i></a>
        <br/>
        <hr/>
        <br/>

        <strong class="text-warning" style="font-size: 35px">Quotes: {{$quotes}}</strong> <a class="float-right" href="{{route('service.view_quote')}}"><i class="fas fa-arrow-circle-right fa-3x"></i></a>
    </div>



@endsection
