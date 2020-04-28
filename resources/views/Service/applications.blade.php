

@extends('Service.index')



@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="{{ url('/service/applications')}}">Applications</a>
    <a class="nav-link active btn-lg mx-5 pt-2 " href="{{ url('/service/jobs')}}">Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Availability Schedule</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Profile</a>
@endsection
@section('mainContent')
    <div class="bookCon">
        <div class="jobList">
            <div class="jobListCon">
                @foreach($applications as $app)
                    <div class="card w-auto">
                        <div class="card-body">
                            <img src="{{$app->imagePath}}" class="card-cmdimg-top" alt="...">
                            <h5 class="card-title">{{$app->title}}</h5>
                            <h5 class="card-title">{{$app->price}}</h5>
                            <p class="card-text">{{$app->description}}</p>
                            <a href="#" class="btn btn-primary float-right mx-1">Accept</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
