@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Service provider id: {{ $sp->id }}</h1>
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
            <form method="post" action="{{route('sp.edit', ['id'=>$sp->id])}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">First Name</label>
                    <input name="fName" class="form-control" value="{{$sp->firstname}}" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Last Name</label>
                    <input name="lName" class="form-control" value="{{$sp->lastname}}" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Email</label>
                    <input name="email" class="form-control" value="{{$sp->email}}" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Phone Number</label>
                    <input name="pNumber" class="form-control" value="{{$sp->phone_number}}" />
                </div>
                <div class="form-group">
                    <a type="button" class="btn btn-danger float-left" href="{{route('sp.index')}}">Back</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
