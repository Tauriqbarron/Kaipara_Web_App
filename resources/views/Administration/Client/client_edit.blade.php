@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Client id: {{ $client->id }}</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>
    <form class="ml-2" method="post" action="{{route('client.edit', ['id' => $client->id])}}" >
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">First Name</label>
                <input name="fName" class="form-control" value="{{$client->first_name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Last Name</label>
                <input name="lName" class="form-control" value="{{$client->last_name}}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <input name="email" class="form-control" value="{{$client->email}}" />
        </div>
        <div class="form-group">
            <label for="inputAddress2">Phone Number</label>
            <input name="pNumber" class="form-control" value="{{$client->phone_number}}" />
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <input name="street" class="form-control" value="{{$client->street}}" />
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <input name="suburb" class="form-control" value="{{$client->suburb}}" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <input name="city" class="form-control" value="{{$client->city}}" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input name="postcode" class="form-control" value="{{$client->postcode}}" />
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{route('client.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
