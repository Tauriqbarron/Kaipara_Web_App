@extends('Service.index')
@section('styles')
    <link rel="stylesheet" href="{{url('css/calendar.css')}}" type="text/css"/>


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
                    <form method="post" action="{{route('service.canceljob', ['id' => $job->id])}}">
                        @csrf

                        <div class="card w-75 cards">
                            <img src="{{$job->application->imagePath}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$job->application->title}}</h5>
                                <h5 class="card-title">{{$job->application->price}}</h5>
                                <p class="card-text">{{$job->application->description}}</p>
                                <button type="submit" class="btn btn-primary float-right mx-1">Cancel</button>
                            </div>
                        </div>

                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
