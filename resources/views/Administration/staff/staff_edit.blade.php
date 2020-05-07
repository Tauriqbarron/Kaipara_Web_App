@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Staff id: {{ $staff->id }}</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>
    <form class="ml-2" method="post" action="{{route('staff.edit', ['id' => $staff->id])}}" >
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">First Name</label>
                <input name="fName" class="form-control" value="{{$staff->first_name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Last Name</label>
                <input name="lName" class="form-control" value="{{$staff->last_name}}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <input name="email" class="form-control" value="{{$staff->email}}" />
        </div>
        <div class="form-group">
            <label for="inputAddress2">Phone Number</label>
            <input name="pNumber" class="form-control" value="{{$staff->phone_number}}" />
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <input name="street" class="form-control" value="{{$staff->street}}" />
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <input name="suburb" class="form-control" value="{{$staff->suburb}}" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <input name="city" class="form-control" value="{{$staff->city}}" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Country</label>
                <input name="country" class="form-control" value="" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input name="postcode" class="form-control" value="{{$staff->postcode}}" />
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{route('staff.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
