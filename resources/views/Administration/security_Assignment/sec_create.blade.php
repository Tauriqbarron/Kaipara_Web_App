@extends('Administration.layout')
@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
    <h1 class="ml-5">Create security assignment</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>

    <form class="ml-2" method="post" action="{{route('security_assignment.create')}}" >
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client_id">Client ID</label>
                <input name="client_id" class="form-control" placeholder="Client ID">
            </div>
            <div class="form-group col-md-6">
                <label for="booking_type">Assignment type</label>
                <select class="form-control" name="booking_type">
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->description}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="descripyion">Description</label>
            <textarea type="text" class="form-control" name="description" rows="3"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" placeholder="YY-mm-dd">
            </div>
            <div class="form-group col-md-6">
                <label for="start_time">Start Time</label>
                <input type="text" name="start_time" class="form-control" placeholder="default: 8.30">
            </div>
            <div class="form-group col-md-6">
                <label for="finish_time">End Time</label>
                <input type="text" name="finish_time" class="form-control" placeholder="default: 16.30">
            </div>

            <div class="form-group col-md-6">
                <label for="numOfStaff">Number of Officer</label>
                <select class="form-control" name="numOfStaff">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Street</label>
                <input name="street" class="form-control" placeholder="Street" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputCity">Suburb</label>
                <input name="suburb" class="form-control" placeholder="Suburb" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <input name="city" class="form-control" placeholder="City" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input name="postcode" class="form-control" placeholder="Postcode" />
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{route('security_assignment.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
    </div>
@endsection
