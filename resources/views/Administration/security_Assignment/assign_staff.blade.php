@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Security assignment id: {{$assignment->id}}</h1>

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>

        <div class="form-row ml-2">
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
        <div class="form-group ml-2">
            <label for="inputAddress">Description</label>
            <p class="form-control">{{$assignment->description}}</p>
        </div>
        <div class="form-group ml-2">
            <label for="inputAddress2">Street</label>
            <p class="form-control">{{$assignment->street}}</p>
        </div>
        <div class="form-row ml-2">
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

    <div class="form-group col-md-2">
        <label for="inputAddress2">Status</label>
        <p class="form-control">{{$assignment->status}}</p>
    </div>
        <div class="form-group col-md-2">
            <label for="available_slots">Available Slots</label>
            <p class="form-control">{{$assignment->available_slots}}</p>
        </div>

        @for($i = 1; $i <= $assignment->available_slots; $i++)
            <form class="form-group" method="post" action="{{route('security_assignment.assign', ['id' => $assignment->id])}}">
                @csrf
                <div class="form-group col-md-2">
                    <label for="inputAddress2">Security Officer</label>
                    <select class="form-control" name="staff">
                        @foreach($staffs as $staff)
                            <option value="{{$staff->id}}">
                            {{$staff->first_name}}
                            {{$staff->last_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="form-control col-md-2 ml-2 btn btn-success">Assign</button>
            </form>
        @endfor
        <br/>
        <a class="btn btn-danger ml-2" href="{{route('security_assignment.index')}}">back</a>
@endsection
