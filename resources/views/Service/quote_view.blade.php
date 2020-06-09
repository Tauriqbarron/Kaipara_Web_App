@extends('Profile.layout')

@section('mainContent')
    <div class="bookCon">
        <div class="jobList">
            <div class="jobListCon">
                @foreach($quotes as $quote)
                    <!--The application detail-->
                    <div class="card w-75 cards">
                        <img src="{{$quote->application->imagePath}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$quote->application->title}}</h5>
                            <p class="card-text">{{$quote->application->description}}</p>
                            <button class="btn btn-success mx-1" type="button" data-toggle="collapse" data-target="#{{$quote->application->title}}" aria-expanded="false" aria-controls="collapseExample">
                                View Quote
                            </button>
                            <hr/>
                            <!--The quote detail-->
                            <div class="collapse my-2" id="{{$quote->application->title}}">

                                <h5>Your Quote:</h5>
                                @if($quote->type == 'totally')
                                    <label><strong>Total price:</strong></label>
                                    <p class="card-text">{{$quote->price}}$</p>
                                    @else
                                    <label><strong>Per-hour price:</strong></label>
                                    <p class="card-text">{{$quote->price}}$</p>
                                    @endif
                                <label><strong>Estimate total hours: </strong></label>
                                <p class="card-text">{{$quote->estimate_hours}}</p>
                                <label><strong>Message sent: </strong></label>
                                <p class="card-text">{{$quote->message}}</p>
                                <a href="#" class="btn btn-secondary float-right">Cancel</a>
                            </div>
                            <!--Quote detail end-->
                        </div>
                    </div>
                        <!--The application detail end-->
                @endforeach
            </div>
        </div>
    </div>

@endsection
