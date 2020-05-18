@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Staff id: {{ $sp->id }}</h1>
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
        <a class="btn btn-primary" href="{{route('sp.index')}}">back</a>
        <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
@endsection
