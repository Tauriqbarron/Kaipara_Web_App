@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Client detail</h1>
    <h2 class="ml-5">Client id: {{$client->id}}</h2>
    <hr/>
    <form class="ml-2">
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
                <p class="form-control">{{$client->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$client->city}}</p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$client->postcode}}</p>
            </div>
        </div>
        <a class="btn btn-danger" href="{{route('client.index')}}">back</a>
    </form>
    </div>
@endsection
