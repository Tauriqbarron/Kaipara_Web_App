@extends('Administration.layout')
@section('mainContent')
    <h1 class="ml-5">Create service provider</h1>
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
            <form method="post" action="{{route('sp.create')}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">First Name</label>
                    <input name="fName" class="form-control" placeholder="First Name" value="{{old('fName')}}"/>
                </div>
                <div class="form-group">
                    <label  class="control-label">Last Name</label>
                    <input name="lName" class="form-control" placeholder="Last Name" value="{{old('lName')}}"/>
                </div>
                <div class="form-group">
                    <label  class="control-label">Email</label>
                    <input name="email" class="form-control" placeholder="Email" value="{{old('email')}}"/>
                </div>
                <div class="form-group">
                    <label  class="control-label">Username</label>
                    <input name="uName" class="form-control" placeholder="Username" value="{{old('uName')}}"/>
                </div>
                <div class="form-group">1
                    <label  class="control-label">Phone Number</label>
                    <input name="pNumber" class="form-control" placeholder="Phone Number" value="{{old('pNumber')}}"/>
                </div>
                <div class="form-group">
                    <label  class="control-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
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
