@extends('Registration.layout')

@section('registration')
        <a class="btn btn-secondary" href="{{url('/selectuser')}}">Back</a>
        <h5 class="mt-2 text-center">Service Provider registration</h5>
        <hr/>

        <form method="POST" action="{{route('reg.service.putToSession')}}">
            @csrf
            <div class="form-group row">
                <label for="firstname" class="col-sm-2 col-form-label">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstname" name="first_name" value="{{old('first_name')}}">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastname" name="last_name" value="{{old('last_name')}}">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{old('username')}}">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p style="font-size: 13px">Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters.</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password:</label>
                <div class="col-sm-10">
                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"/>
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number:</label>
                <div class="col-sm-2">
                <input name="phone_number1" class="form-control @error('phone_number1') is-invalid @enderror" placeholder="02x" value="{{old('phone_number')}}"/>
                @error('phone_number1')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-4">
                    <input name="phone_number2" class="form-control @error('phone_number2') is-invalid @enderror" placeholder="xxxxxxx" value="{{old('phone_number')}}"/>
                    @error('phone_number2')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Next</button>
        </form>
@endsection
