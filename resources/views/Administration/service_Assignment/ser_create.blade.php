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

        <form class="ml-2" method="post" action="{{route('admin.service.create')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="client_id">Client ID</label>
                    <input type="text" name="client_id" class="form-control" placeholder="Client ID">
                </div>
                <div class="form-group col-md-6">
                    <label for="booking_type">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="descripyion">Description</label>
                <textarea type="text" class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price, can be entered later">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="start_time">Start Time</label>
                    <input type="time" name="start_time" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="finish_time">End Time</label>
                    <input type="time" name="finish_time" class="form-control">
                </div>

                <div class="form-row">
                <div class="form-group col-9">
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
            </div>
            <a type="button" class="btn btn-danger" href="{{URL::previous()}}">Back</a>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>








@endsection
