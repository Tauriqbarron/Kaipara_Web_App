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
    <div class="row ml-5">
        <div class="col-md-4">
            <form method="post" action="{{route('sp.delete', ['id'=>$sp->id])}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">First Name</label>
                    <p class="form-control">{{$sp->firstname}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Last Name</label>
                    <p class="form-control">{{$sp->lastname}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Username</label>
                    <p class="form-control">{{$sp->username}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Email</label>
                    <p class="form-control">{{$sp->email}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Phone Number</label>
                    <p class="form-control">{{$sp->phone_number}}</p>
                </div>
                <div class="form-group">
                    <a type="button" class="btn btn-primary float-left" href="{{route('sp.index')}}">Back</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection
