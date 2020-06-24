@extends('Profile.layout')

@section('mainContent')
    <h1 id="No_jobs"></h1>
    <div class="bookCon">
        <div class="jobList">
            <div class="jobListCon" id="jobs">
                @foreach($quotes as $quote)
                    <!--The application detail-->
                        <form method="post" action="{{route('service.cancel_quote', ['id' => $quote->id])}}">
                            @csrf
                    <div class="card w-75 cards">
                        <img src="{{url($quote->application->job_type->imgPath)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <label><strong>Title: </strong></label> {{$quote->application->title}}<br/>
                            <label><strong>Price: </strong></label> &nbsp;null&nbsp;&nbsp;
                            <strong>Job type: </strong>{{$quote->application->job_type->description}}<br/>

                            <label><strong>Description: </strong></label>
                            <p class="card-text">{{$quote->application->description}}</p>
                            <strong>Client: </strong>{{$quote->application->client->first_name}} {{$quote->application->client->last_name}}&nbsp;&nbsp;
                            <strong>Phone Number: </strong>{{$quote->application->client->phone_number}}<br/>
                            <strong>Address: </strong>{{$quote->application->street}}, {{$quote->application->suburb}}, {{$quote->application->city}}<br/>
                            <strong>Start Date: </strong>{{$quote->application->date}}
                            <br/><br/><button class="btn btn-success mx-1" type="button" data-toggle="collapse" data-target="#{{$quote->application->title}}" aria-expanded="false" aria-controls="collapseExample">
                                View Quote
                            </button>
                            <hr/>
                            <!--The quote detail-->
                            <div class="collapse my-2" id="{{$quote->application->title}}">
                                <h5>Your Quote:</h5>
                                <label><strong>Total price:</strong></label>
                                <p class="card-text">{{$quote->price}}$</p>
                                <label><strong>Message sent: </strong></label>
                                <p class="card-text">{{$quote->message}}</p>
                                <label><strong>Status: </strong></label>
                                @if($quote->status == 1)
                                    <p class="card-text">pending</p>
                                    <button type="submit" class="btn btn-secondary float-right">Cancel</button>
                                @elseif($quote->status == 2)
                                    <p class="card-text">accepted</p>
                                    <a href="#" class="btn btn-secondary disabled float-right">Accepted</a>
                                    @endif
                            </div>
                            <!--Quote detail end-->
                        </div>
                    </div>
                        <!--The application detail end-->
                        </form>
                @endforeach
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        if($('#jobs').contents().length == 1) {
            $('#No_jobs').text('No Quotes Currently')
        }
    </script>

@endsection
