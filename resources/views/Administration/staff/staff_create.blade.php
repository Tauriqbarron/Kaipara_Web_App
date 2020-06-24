@extends('Administration.layout')
@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
    <h1 class="">Create staff</h1>
    <hr/>
    <form class="justify-content-center" method="post" action="{{route('staff.create')}}" >
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First Name:</label>
                <input name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{old('first_name')}}">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="last_name">Last Name:</label>
                <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{old('last_name')}}"/>
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}"/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <label for="phone_number">Phone Number:</label>
        <div class="form-group row ml-0">
            <input name="phone_number1" style="width: 100px" class="form-control @error('phone_number1') is-invalid @enderror" placeholder="02x" value="{{old('phone_number1')}}"/>
            @error('phone_number1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="col-md-4">
            <input name="phone_number2" class="form-control @error('phone_number2') is-invalid @enderror" placeholder="xxxxxxx" value="{{old('phone_number2')}}"/>
            @error('phone_number2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="street">Street:</label>
            <input name="street" class="form-control @error('street') is-invalid @enderror" placeholder="Street" value="{{old('street')}}"/>
            @error('street')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="suburb">Suburb:</label>
                <input name="suburb" class="form-control @error('suburb') is-invalid @enderror" placeholder="Suburb" value="{{old('suburb')}}"/>
                @error('suburb')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="city">City:</label>
                <input name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{old('city')}}"/>
                @error('city')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-2">
                <label for="inputZip">Zip:</label>
                <input name="postcode" class="form-control @error('postcode') is-invalid @enderror" placeholder="Postcode" />
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="float-right text-danger">Staff will receive email to setting their password.</div>
        <br/>
        <br/>
        <a type="button" class="btn btn-danger" href="{{route('staff.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
    </div>
@endsection
