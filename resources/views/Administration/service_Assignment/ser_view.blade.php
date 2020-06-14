@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Assignment detail</h1>
    <h2 class="ml-5">Property service assignment id: {{$assignment->id}}</h2>
    <hr/>
    <form class="ml-2">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Client Name</label>
                <p class="form-control">
                    {{$assignment->client->first_name}}
                    {{$assignment->client->last_name}}
                </p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Assignment Title</label>
                <p class="form-control">{{$assignment->title}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Description</label>
            <p class="form-control">{{$assignment->description}}</p>
        </div>
        <div class="form-group w-25">
            <label for="inputAddress2">Price</label>
            <p class="form-control">{{$assignment->price}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <p name="date" class="form-control">{{$assignment->date}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="start_time">Start Time</label>
                <p name="start_time" class="form-control">{{$assignment->start_time}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="finish_time">End Time</label>
                <p name="finish_time" class="form-control">{{$assignment->finish_time}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$assignment->street}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <p class="form-control">{{$assignment->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$assignment->city}}</p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$assignment->postCode}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Service Provider</label>
            <p class="form-control">
                @if($assignment->service_provider_job != null)
                    {{$assignment->service_provider_job->service_provider->firstname}}
                    {{$assignment->service_provider_job->service_provider->lastname}}
                @else
                    This assignment is currently available.
                @endif

            </p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Status</label>
            @if($assignment->status == 1)
            <p class="form-control">available</p>
                @else
            <p class="form-control">accepted</p>
                @endif
        </div>
        <a class="btn btn-danger" href="{{URL::previous()}}">back</a>
    </form>
    </div>
@endsection
