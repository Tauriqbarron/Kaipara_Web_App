@extends('Administration.layout')
@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
    <h1 class="ml-5">Create client</h1>

    <hr/>
    <form class="ml-2" method="post" action="{{route('client.create')}}" >
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
                <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{old('last_name')}}" />
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="inputAddress">Email:</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputAddress">Password:</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password"/>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <p style="font-size: 13px">Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters.</p>
        </div>

        <div class="form-group">
            <label for="inputAddress">Confirm Password:</label>
            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="confirm password" />
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <label for="phone_number">Phone Number:</label>
        <div class="form-group row ml-0">
            <input name="phone_number1" style="width: 60px" class="form-control @error('phone_number1') is-invalid @enderror" placeholder="xxx" value="{{old('phone_number')}}"/>
            @error('phone_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="col-md-4">
                <input name="phone_number2" class="form-control @error('phone_number2') is-invalid @enderror" placeholder="xxxxxxx" value="{{old('phone_number')}}"/>
                @error('phone_number2')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="street">Street:</label>
            <input name="street" class="form-control @error('street') is-invalid @enderror" placeholder="Street" value="{{old('street')}}" />
            @error('street')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="suburb">Suburb:</label>
                <input name="suburb" class="form-control @error('suburb') is-invalid @enderror" placeholder="Suburb" value="{{old('suburb')}}" />
                @error('suburb')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="city">City:</label>
                <input name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{old('city')}}" />
                @error('city')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-2">
                <label for="postcode">Zip:</label>
                <input name="postcode" class="form-control @error('postcode') is-invalid @enderror" placeholder="Postcode" value="{{old('postcode')}}" />
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{route('client.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
    </div>
@endsection
