@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Security assignment id: {{$assignment->id}}</h1>
    <hr/>
    <form class="ml-2">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Client Name</label>
                <p class="form-control">
                    {{$assignment->booking->client->first_name}}
                    {{$assignment->booking->client->last_name}}

                </p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Assignment Type</label>
                <p class="form-control">{{$assignment->booking->booking_type->description}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Description</label>
            <p class="form-control">{{$assignment->booking->description}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$assignment->booking->street}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <p class="form-control">{{$assignment->booking->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$assignment->booking->city}}</p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$assignment->booking->postcode}}</p>
            </div>
        </div>

        <div class="form-group">
            <label for="inputAddress2">Security Officer</label>
            <p class="form-control">
                {{$assignment->staff->first_name}}
                {{$assignment->staff->last_name}}
            </p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Status</label>
            <p class="form-control">{{$assignment->booking->status}}</p>
        </div>
        <a class="btn btn-danger" href="{{route('security_assignment.index')}}">back</a>
    </form>
@endsection
