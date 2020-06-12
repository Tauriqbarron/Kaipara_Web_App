@extends('Registration.layout')

@section('registration')
    <h5 class="mt-2 text-center">Address Form</h5>
    <hr/>

    <form method="POST" action="{{route('reg.client.save')}}">
        @csrf
        <div class="form-group row">
            <label for="street" class="col-sm-2 col-form-label">Street</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="street" name="street">
            </div>
        </div>
        <div class="form-group row">
            <label for="suburb" class="col-sm-2 col-form-label">Suburb</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="suburb" name="suburb">
            </div>
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label">Zip</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="postcode">
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>



@endsection
