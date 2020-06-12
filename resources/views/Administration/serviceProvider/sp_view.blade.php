@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Service provider detail</h1>
    <h2 class="ml-5">Service Provider id: {{$sp->id}}</h2>
    <hr/>
    <form class="ml-2">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">First Name</label>
                <p class="form-control">{{$sp->firstname}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Last Name</label>
                <p class="form-control">{{$sp->lastname}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <p class="form-control">{{$sp->email}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Phone Number</label>
            <p class="form-control">{{$sp->phone_number}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$sp->street}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <p class="form-control">{{$sp->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$sp->city}}</p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$sp->postcode}}</p>
            </div>
        </div>
        <a class="btn btn-danger" href="{{route('sp.index')}}">back</a>
    </form>
    </div>


@endsection
