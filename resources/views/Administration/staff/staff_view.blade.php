@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Staff id: {{$staff->id}}</h1>
    <hr/>
    <form class="ml-2">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">First Name</label>
                <p class="form-control">{{$staff->first_name}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Last Name</label>
                <p class="form-control">{{$staff->last_name}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <p class="form-control">{{$staff->email}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Phone Number</label>
            <p class="form-control">{{$staff->phone_number}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$staff->street}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <p class="form-control">{{$staff->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$staff->city}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Country</label>
                <p class="form-control"></p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$staff->postcode}}</p>
            </div>
        </div>
        <a class="btn btn-danger" href="{{route('staff.index')}}">back</a>
    </form>



@endsection