@extends('Profile.layout')
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
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
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
                                        <label><strong>Price: </strong></label>
                                        <h5 class="card-title text-primary">${{$app->price}}</h5>
                                    @endif
                                    <strong>Client:</strong>
                                    <p class="card-text">{{$app->client->first_name}} {{$app->client->last_name}}</p>
                                    <strong>Phone Number:</strong>
                                    <p class="card-text">{{$app->client->phone_number}}</p>
                                    <strong>Description: </strong>
                                    <p class="card-text">{{$app->description}}</p>
                                    <strong>Address: </strong>
                                    <p class="card-text">{{$app->street}}, {{$app->suburb}}, {{$app->city}}</p>
                                </div>
                            </div>
                            <br/>
                            @if($app->price == NULL)
                                <button class="btn btn-success float-right mx-1" type="button" data-toggle="collapse" data-target="#{{$app->title}}" aria-expanded="false" aria-controls="collapseExample">
                                    Create Quote
                                </button>
                                <div class="collapse my-2" id="{{$app->title}}">
                                    <!--Quote section-->
                                    <div class="card card-body">
                                        <h5 class="card-title">Quote</h5>
                                        <hr/>
                                        <!--Normal quote-->
                                        <form method="post" action="{{route('service.quote',['id' => $app->id])}}" id="normal_quote">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="price">Enter a total price: </label>
                                                <input type="text" class="form-control w-25" id="price" name="price">
                                            </div>
                                            <div class="form-group row">
                                                <label for="message">Please include a short message with your quote:</label>
                                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Send Quote</button>
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

    <script>
        //Show totally quote type form or show hourly form.
        function select_quote_type() {
            var total = document.getElementById('totally');
            var hour = document.getElementById('hourly');
            if(total.checked) {
                document.getElementById('normal_quote').style.display = 'block';
                document.getElementById('hourly_quote').style.display = 'none';
            }else {
                document.getElementById('normal_quote').style.display = 'none';
                document.getElementById('hourly_quote').style.display = 'block';
            }
        }
    </script>
@endsection
