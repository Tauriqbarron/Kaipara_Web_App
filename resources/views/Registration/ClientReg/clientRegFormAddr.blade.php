@extends('Registration.layout')

@section('registration')
    <h5 class="mt-2 text-center">Address Form</h5>
    <hr/>

    <form method="POST" action="{{route('reg.client.save')}}">
        @csrf
        <div class="form-group row">
            <label for="street" class="col-sm-2 col-form-label">Street</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" name="street" value="{{old('street')}}">
                @error('street')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="suburb" class="col-sm-2 col-form-label">Suburb</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('suburb') is-invalid @enderror" id="suburb" name="suburb" value="{{old('suburb')}}">
                @error('suburb')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{old('city')}}">
                @error('city')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label">Zip</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="city" name="postcode" value="{{old('postcode')}}">
                @error('postcode')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>



@endsection
