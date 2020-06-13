@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Delete service provider</h1>
    <h2 class="ml-5">Staff id: {{ $sp->id }}</h2>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>
    <form class="ml-2" method="post" action="{{route('sp.delete', ['id' => $sp->id])}}">
        @csrf
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
            <label for="inputAddress">Username</label>
            <p class="form-control">{{$sp->username}}</p>
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
        <div class="float-right text-danger">Are you sure you want to delete this service provider record?</div>
        <br/>
        <br/>
        <a class="btn btn-primary" href="{{route('sp.index')}}">back</a>
        <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
    </div>
@endsection
