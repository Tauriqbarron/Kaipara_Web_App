@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Delete assignment</h1>
    <h2 class="ml-5">Security assignment id: {{$assignment->id}}</h2>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
    <hr/>
    <form class="ml-2" method="post" action="{{route('security_assignment.delete', ['id' => $assignment->id])}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Client Name</label>
                <p class="form-control">
                    {{$assignment->client->first_name}}
                    {{$assignment->client->last_name}}
                </p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Assignment Type</label>
                <p class="form-control">{{$assignment->booking_type->description}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Description</label>
            <p class="form-control">{{$assignment->description}}</p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$assignment->street}}</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Suburb</label>
                <p class="form-control">{{$assignment->suburb}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <p class="form-control">{{$assignment->city}}</p>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <p class="form-control">{{$assignment->postcode}}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <p name="date" class="form-control">{{$assignment->date}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="start_time">Start Time</label>
                <p name="start_time" class="form-control">{{$assignment->start_time}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="finish_time">End Time</label>
                <div name="finish_time" class="form-control">{{$assignment->finish_time}}</div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Security Officer</label>
            <p class="form-control">
                @foreach($assignment->staff_assignments as $record)
                    {{$record->staff->first_name}}
                    {{$record->staff->last_name}}
                @endforeach
            </p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Status</label>
            <p class="form-control">{{$assignment->status}}</p>
        </div>
        <div class="float-right text-danger">Are you sure you want to delete this assignment record?</div>
        <br/>
        <br/>
        <a class="btn btn-success" href="{{route('security_assignment.index')}}">back</a>
        <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
    </div>
@endsection
