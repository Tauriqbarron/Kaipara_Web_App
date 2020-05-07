@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Client id: {{$client->id}}</h1>
    <hr/>
    <form class="ml-2" method="post" action="{{route('client.delete', ['id' => $client->id])}}">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">First Name</label>
                <p class="form-control">{{$client->first_name}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Last Name</label>
                <p class="form-control">{{$client->last_name}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <p class="form-control">{{$client->email}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Phone Number</label>
            <p class="form-control">{{$client->phone_number}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$client->street}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <<p class="form-control">{{$client->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$client->city}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Country</label>
                <p class="form-control"></p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$client->postcode}}</p>
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('client.index')}}">back</a>
        <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
@endsection
