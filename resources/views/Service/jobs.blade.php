@extends('Service.index')
@section('styles')
    <link rel="stylesheet" href="{{url('css/calendar.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{url('css/service.css')}}" type="text/css"/>

@endsection
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{ url('/service/applications')}}">Applications</a>
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white " href="{{ url('/service/jobs')}}">Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Availability Schedule</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Profile</a>
@endsection
@section('mainContent')

    <div class="bookCon">
        <div class="jobList">
            <div class="jobListCon">
                @foreach($jobs as $job)
                    <div class="card w-auto">
                        <div class="card-body">
                            <img src="{{$job->imagePath}}" class="card-cmdimg-top" alt="...">
                            <h5 class="card-title">{{$job->title}}</h5>
                            <h5 class="card-title">{{$job->price}}</h5>
                            <p class="card-text">{{$job->description}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
