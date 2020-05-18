@extends('Administration.layout')
@section('mainContent')
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
        <!--<div class="form-row">
            <div class="form-group">
                <label for="inputAddress">Security Officer</label>
                <select class="form-control" name="security_officer">
                    <option value=" "> </option>
                   {{--@foreach($staffs as $staff)
                        <option value="{{$staff->id}}">{{$staff->first_name}} {{$staff->last_name}}</option>
                    @endforeach--}}
                </select>
            </div>
        </div>
        -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input type="text" name="date" class="form-control" placeholder="dd-mm-YY">
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
@endsection
