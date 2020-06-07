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
                    <div class="card w-75 mx-auto my-4 bg-light border-0 shadow-sm">
                        <div class="card-body ">
                            <img src="{{$app->imagePath}}" class="card-img-top w-75" alt="...">
                            <h5 class="card-title my-2">{{$app->title}}</h5>
                            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#{{$app->id}}" aria-expanded="false" aria-controls="collapseExample">
                                <h6>View Details</h6>
                            </button>
                            <div class="collapse my-2" id="{{$app->id}}">
                                <div class="card card-body">
{{--                                    TODO create if statement for Quotable to be displayed --}}
                                    @if($app->price == NULL)
                                        <h5 class="card-title text-primary">Quotable</h5>
                                    @else
                                        <h5 class="card-title text-primary">${{$app->price}}</h5>
                                    @endif
                                    <p class="card-text">{{$app->description}}</p>
                                </div>
                            </div>
                            @if($app->price == NULL)
                                <button class="btn btn-success float-right mx-1" type="button" data-toggle="collapse" data-target="#{{$app->title}}" aria-expanded="false" aria-controls="collapseExample">
                                    Create Quote
                                </button>
                                <div class="collapse my-2" id="{{$app->title}}">
                                    <div class="card card-body">
                                        <form method="GET" action="{{route('service.quote',['id' => $app->id])}}">
                                            <div class="form-group row">
                                                <label for="price" class="col-sm-2 col-form-label">Enter Price</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="price" name="price">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="message">Please include a short message with your quote</label>
                                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send Quote</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a href="{{route('service.acceptJob',['id' => $app->id])}}" class="btn btn-success float-right mx-1">Accept</a>
    {{--                            TODO create offer function --}}
                                <a href="" class="btn btn-link float-right mx-1">Send Offer</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
