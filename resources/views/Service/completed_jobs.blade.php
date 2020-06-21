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
                    @if($job->application->status == 4)
                        <div class="card w-75 cards">
                            <img src="{{url($job->application->job_type->imgPath)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <label><strong>Title: </strong></label> {{$job->application->title}}<br/>
                                <label><strong>Price: </strong></label>
                                ${{$job->application->price}}&nbsp;&nbsp;
                                <strong>Job type: </strong>{{$job->application->job_type->description}}<br/>
                                <label><strong>Description: </strong></label>
                                <p class="card-text">{{$job->application->description}}</p>
                                <strong>Client: </strong>{{$job->application->client->first_name}} {{$job->application->client->last_name}}&nbsp;&nbsp;
                                <strong>Phone Number: </strong>{{$job->application->client->phone_number}}<br/>
                                <strong>Address: </strong>{{$job->application->street}}, {{$job->application->suburb}}, {{$job->application->city}}<br/>
                                <strong>Start Date: </strong>{{$job->application->date}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Finish Date: </strong>{{$job->application->end_date}}
                                <br/><label><strong>Status: </strong></label>
                                    Completed
                                <a href="#" class="btn btn-secondary disabled float-right">Completed</a>
                                @if(count($job->service_feedback) < 1)
                                    <button data-toggle="modal" data-target="#f{{$job->id}}" class="btn btn-primary float-right">Feedback</button>
                                    @php($client = $job->application->client)
                                @endif
                            </div>
                        </div>

                        @if(count($job->service_feedback) < 1)
                        <div class="modal" id="f{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="modalTestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header container">
                                        <div class="row">
                                            <div class="modal-client-image col-3">
                                                <img src="{{isset($client->imgPath) ? url($client->imgPath) : url('images/Profile_Placeholder_Large.jpg')}}" class="rounded-circle w-100" alt="Worker Image" >
                                            </div>
                                            <div class="col-9 text-left">
                                                <div class="row">
                                                    <h5 class="modal-title" id="modalTestLabel">{{$client->first_name}} {{$client->last_name}}</h5>
                                                </div>
                                                <div class="row">
                                                    <h5>Score: {{count($client->service_feedback)>0 ? $client->service_feedback->avg('rating') : 'Pending'}} </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-content container">
                                            <div class="row">
                                                <div class="col-3 text-right font-weight-bold">
                                                    Email
                                                </div>
                                                <div class="col-9">
                                                    {{$client->email}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 text-right font-weight-bold">
                                                    Phone
                                                </div>
                                                <div class="col-9">
                                                    {{$client->phone_number}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container rounded bg-light mt-3 py-3">
                                            <form method="post" class="needs-validation" action="{{route('service.jobs.postFeedback')}}">
                                                @csrf
                                                <h5>Job Feedback</h5>
                                                <input type="hidden" name="service_provider_job_id" value="{{$job->id}}">

                                                <label for="rating">Rating:</label>
                                                <div class="rating btn-group form-group" id="rating" role="group">
                                                    <input type="radio" name="star" id="{{$job->id}}star5" value="5"><label for="{{$job->id}}star5"></label>
                                                    <input type="radio" name="star" id="{{$job->id}}star4" value="4"><label for="{{$job->id}}star4"></label>
                                                    <input type="radio" name="star" id="{{$job->id}}star3" value="3"><label for="{{$job->id}}star3"></label>
                                                    <input type="radio" name="star" id="{{$job->id}}star2" value="2"><label for="{{$job->id}}star2"></label>
                                                    <input type="radio" name="star" id="{{$job->id}}star1" value="1"><label for="{{$job->id}}star1"></label>
                                                </div>
                                                <div>
                                                    <label for="messageBox">Message:</label>
                                                </div>
                                                <div>
                                                    <textarea name="message" class="float-left w-100 form-control" id="messageBox" rows="5" maxlength="300" required></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <input class="btn btn-success mt-2" type="submit" value="Send Feedback">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                @endforeach
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        if($('#jobs').contents().length == 0) {
            $('#No_jobs').text('No Completed Jobs Currently')
        }
    </script>
@endsection
