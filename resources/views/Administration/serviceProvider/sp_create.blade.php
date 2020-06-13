@extends('Administration.layout')
@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
    <h1 class="ml-5">Create service provider</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>
    <form class="justify-content-center" method="post" action="{{route('sp.create')}}" >
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">First Name</label>
                <input name="fName" class="form-control" placeholder="First Name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Last Name</label>
                <input name="lName" class="form-control" placeholder="Last Name" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Username</label>
            <input name="uName" type="text" class="form-control" placeholder="Username" />
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Email" />
        </div>
        <div class="form-group">
            <label for="inputAddress">Password</label>
            <input name="password" type="password" class="form-control" placeholder="password" />
        </div>
        <div class="form-group">
            <label for="inputAddress">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="confirm password" />
        </div>


        <div class="form-group">
            <label for="inputAddress2">Phone Number</label>
            <input name="pNumber" class="form-control" placeholder="Phone Number" />
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <input name="street" class="form-control" placeholder="Street" />
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <input name="suburb" class="form-control" placeholder="Suburb" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <input name="city" class="form-control" placeholder="City" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input name="postcode" class="form-control" placeholder="Postcode" />
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{route('sp.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
    </div>
@endsection
