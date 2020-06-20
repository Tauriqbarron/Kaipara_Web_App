@extends('Profile.layout')
@section('styles')
    <link rel="stylesheet" href="{{url('css/calendar.css')}}" type="text/css"/>


@endsection

@section('mainContent')
    <h1 id="No_jobs"></h1>
    <div class="bookCon">
        <div class="jobList">
            <div class="jobListCon" id="jobs">
                    @foreach($jobs as $job)
                            @if($job->application->status != 4)
                            <form method="post" action="{{route('service.canceljob', ['id' => $job->id])}}">
                                @csrf
                                <div class="card w-75 cards">
                                    <img src="{{url($job->application->job_type->imgPath)}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <label><strong>Title: </strong></label> {{$job->application->title}}<br/>
                                        <label><strong>Price: </strong></label>{{$job->application->price}}$ &nbsp;&nbsp;  <strong>Job type: </strong>{{$job->application->job_type->description}}<br/>
                                        <label><strong>Description: </strong></label>
                                        <p class="card-text">{{$job->application->description}}</p>
                                        <strong>Client: </strong>{{$job->application->client->first_name}} {{$job->application->client->last_name}}&nbsp;&nbsp;
                                        <strong>Phone Number: </strong>{{$job->application->client->phone_number}}<br/>
                                        <strong>Address: </strong>{{$job->application->street}}, {{$job->application->suburb}}, {{$job->application->city}}<br/>
                                        <strong>Start Date: </strong>{{$job->application->date}}
                                        <br/><label><strong>Status: </strong></label>
                                        @if($job->application->status == 2)
                                            Accepted
                                        @elseif($job->application->status == 3)
                                            Started
                                        @elseif($job->application->status == 4)
                                            Completed
                                        @endif
                                        <br/><input type="hidden" name="end_date" value="{{date('Y-m-d')}}">
                                        @if($job->application->status == 2)
                                            <a href="{{route('service.job.start', ['id' => $job->application->id])}}" class="btn btn-success float-right mx-auto">Start Job</a>
                                            <button type="submit" class="btn btn-primary float-right mx-1">Cancel</button>
                                        @elseif($job->application->status == 3)
                                            <a href="{{route('service.job.complete', ['id' => $job->application->id])}}" class="btn btn-success float-right">Complete</a>
                                            <button type="submit" class="btn btn-primary float-right mx-1">Cancel</button>
                                            @elseif($job->application->status == 4)
                                            <a href="#" class="btn btn-secondary disabled float-right">Completed</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @endif
                    @endforeach
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        if($('#jobs').contents().length == 1) {
            $('#No_jobs').text('No Jobs Currently')
        }
    </script>
@endsection
