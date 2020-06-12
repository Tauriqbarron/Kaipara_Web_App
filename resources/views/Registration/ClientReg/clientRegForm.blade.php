@extends('Registration.layout')

@section('registration')
        <a class="btn btn-secondary" href="{{url('/selectuser')}}">Back</a>
        <h5 class="mt-2 text-center">Client registration</h5>
        <hr/>

        <form method="POST" action="{{route('reg.client.putToSession')}}">
            @csrf
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password:</label>
                <div class="col-sm-10">
                    <input name="password_confirmation" type="password" class="form-control"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstname" class="col-sm-2 col-form-label">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastnname" class="col-sm-2 col-form-label">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="pNumber">
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Next</button>
        </form>
@endsection
