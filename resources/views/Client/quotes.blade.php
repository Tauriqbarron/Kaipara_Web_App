@extends('Client.layout')
@section('nav')

    <a href="{{route('client.dashboard')}}" id="profileBtn"><img  src="{{url('images/Dashboard_active.png')}}" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 " id="collapsingNavbar3">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{route('client.security')}}" >Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.property')}}">Property Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.jobs')}}">Service Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.bookings')}}">Security Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('client.quotes')}}">Quotes</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.settings')}}">Settings</a>
            </li>
        </ul>
    </div>
@endsection
@section('mainContent')
    <div class="row">
        <div class="container ml-3">
            <div class="row">
                <div class="col">
                    <h4 class="w-100 text-center">Your Service Job Quotes</h4>
                    <div class="container jumbotron p-3">

                        <div class="row text-center px-2">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 text-right">
                                        <a class="" href="{{isset($filtered) ? route('client.quotes') : "#"}}">{{isset($filtered) ? 'Show All' : ''}}</a>
                                    </div>
                                    <div class="col-8">
                                        <label for="filter" hidden>Filter Results</label><select id="filter" class="form-control" onchange="window.location.href = this.options[selectedIndex].value">
                                            <option class="text-secondary font-italic" disabled selected hidden>Filter Results</option>
                                            <option value="{{route('client.acceptedQuotes')}}">Accepted Quotes</option>
                                            <option value="{{route('client.declinedQuotes')}}">Declined Quotes</option>
                                            @foreach($applications as $app)
                                                <option value="{{route('client.filterQuotes', ['id' => $app->id])}}">Job: {{$app->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            console.log({!! json_encode($applications) !!});
                            console.log({!! json_encode($quotes) !!});
                        </script>
                        @foreach($quotes as $quote)
                            <div class="row bg-light border-bottom p-2">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-1">
                                            <img class="quote-provider-image rounded-circle" src="{{isset($quote->service_provider->imgPath) ? url($quote->service_provider->imgPath) : url('images/Profile_Placeholder.png')}}">
                                        </div>
                                        <div class="col-3">
                                            {{$quote->service_provider->firstname}} {{$quote->service_provider->lastname}}
                                        </div>
                                        <div class="col-7 font-weight-bold">
                                            RE: {{$quote->application->title}}
                                        </div>
                                        <div class="col-1 btn-group-toggle  toggle-btn">
                                            <input type="radio" class="" id="btna{{$quote->id}}" data-toggle="collapse" data-target="#a{{$quote->id}}" aria-errormessage="false" aria-controls="a{{$quote->id}}">
                                            <label class="rounded bg-secondary text-center" for="btna{{$quote->id}}"></label>
                                        </div>
                                    </div>
                                    {{--Quote Info--}}
                                    <div class="row bg-white collapse p-3  shadow-sm" id="a{{$quote->id}}">
                                        <div class="col">
                                            <div class="row pl-2">
                                                <div class="col pl-5">
                                                    <h5>RE: {{$quote->application->title}}</h5>
                                                </div>

                                            </div>
                                            <div class="row mb-3 border-bottom border-light">
                                                <div class="col text-secondary">
                                                    <img class="quote-provider-image rounded-circle" src="{{isset($quote->service_provider->imgPath) ? url($quote->service_provider->imgPath) : url('images/Profile_Placeholder.png')}}">
                                                    {{$quote->service_provider->firstname}} {{$quote->service_provider->lastname}}: {{$quote->service_provider->email}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col ">
                                                    <h5>{{$quote->application->title}}</h5>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col text-secondary">
                                                    <em>{{$quote->application->description}}</em>
                                                </div>
                                            </div>
                                            <div class="row border-light border-bottom mb-4">
                                                <div class="col">
                                                    {{$quote->application->street}}, {{$quote->application->suburb}}, {{$quote->application->city}}, {{$quote->application->postCode}}
                                                </div>
                                            </div>
                                            <div class="row bg-light pl-2">
                                                <div class="col">
                                                    <div class="row jumbotron p-3 bg-dark text-light m-3">
                                                        <img class="quote-provider-image rounded-circle" src="{{isset($quote->service_provider->imgPath) ? url($quote->service_provider->imgPath) : url('images/Profile_Placeholder.png')}}">
                                                         {{$quote->service_provider->firstname}}: "<em>{{$quote->message}}</em>"
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6"></div>
                                                        <div class="col-2 text-right">
                                                            <strong>Estimated Price</strong>
                                                        </div>
                                                        <div class="col-1">
                                                            {{'$' . number_format($quote->price, 2)}}
                                                        </div>
                                                        <div class="col-2 text-right">
                                                            <strong>Estimated Hours</strong>
                                                        </div>
                                                        <div class="col-1">
                                                            {{$quote->estimate_hours}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row bg-light pl-2 pr-3 pt-3">
                                                <div class="col text-right">
                                                    @if(!isset($accepted))
                                                    <form method="POST" action="{{route('client.acceptQuote')}}">
                                                        @csrf
                                                        <input type="hidden" name="service_provider_id" value="{{$quote->service_provider_id}}">
                                                        <input type="hidden" name="quote_id" value="{{$quote->id}}">
                                                        <input type="hidden" name="price" value="{{$quote->price}}">

                                                        <button onclick="window.location.href = '{{route('client.declineQuote', ['id'=>$quote->id])}}'" class="btn btn-danger">Decline</button>
                                                        <input type="submit" class="btn btn-success" value="Accept">
                                                    </form>
                                                    @elseif($accepted)
                                                        <button class="btn btn-danger" disabled>Decline</button>
                                                        <button class="btn btn-secondary" disabled>Accepted</button>
                                                    @else
                                                        <button class="btn btn-secondary" disabled>Declined</button>
                                                        <button class="btn btn-success" disabled>Accept</button>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

