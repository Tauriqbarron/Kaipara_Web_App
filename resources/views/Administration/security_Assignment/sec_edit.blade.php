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

    <form class="ml-2" method="post" action="{{route('security_assignment.edit', ['id' => $assignment->id])}}">

        @csrf
        <!--The client name and the type of this assignment-->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client_id">Client Name</label>
                <p name="client_id" class="form-control">
                    {{$assignment->client->first_name}}
                    {{$assignment->client->last_name}}
                </p>
            </div>
            <div class="form-group col-md-6">
                <label for="booking_type">Assignment type</label>
                <select class="form-control" name="booking_type">
                    @foreach($types as $type)
                        @if($type->id == $assignment->booking_type_id)
                            <option value="{{$type->id}}" selected="selected">{{$type->description}}</option>
                        @else
                            <option value="{{$type->id}}">{{$type->description}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="descripyion">Description</label>
            <textarea type="text" class="form-control" name="description" rows="3">{{$assignment->description}}</textarea>
        </div>

        <!--The date, time, number of staff and the address-->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input type="text" name="date" class="form-control" value="{{$assignment->date}}">
            </div>
            <div class="form-group col-md-6">
                <label for="start_time">Start Time</label>
                <input type="text" name="start_time" class="form-control" value="{{$assignment->start_time}}">
            </div>
            <div class="form-group col-md-6">
                <label for="finish_time">End Time</label>
                <input type="text" name="finish_time" class="form-control" value="{{$assignment->finish_time}}">
            </div>

            <div class="form-group col-md-6">
                <label for="numOfStaff">Number of Officer</label>
                <select class="form-control" name="numOfStaff">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i == $assignment->staff_needed)
                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                        @else
                            <option value="{{$i}}">{{$i}}</option>
                        @endif
                        @endfor
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Street</label>
                <input name="street" class="form-control" value="{{$assignment->street}}" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputCity">Suburb</label>
                <input name="suburb" class="form-control" value="{{$assignment->suburb}}" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <input name="city" class="form-control" value="{{$assignment->city}}" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input name="postcode" class="form-control" value="{{$assignment->postcode}}" />
            </div>
        </div>
            <div class="form-group w-25">
                <label for="inputAddress2">Status</label>
                <select class="form-control" name="status">
                    @if($assignment->status == 'available')
                        <option value="available" selected="selected">available</option>
                        <option value="assigned">assigned</option>
                    @else
                        <option value="available">available</option>
                        <option value="assigned" selected="selected">assigned</option>
                    @endif
                </select>
            </div>



        <!--Change staff-->
        <div class="form-group w-25">
            @if(\App\Staff_Assignment::where('booking_id', '=', $assignment->id)->exists())
                    @foreach($assignment->staff_assignments as $record)
                    <label for="inputAddress2">Security Officer</label>
                    <p class="form-control">
                        {{$record->staff->first_name}}
                        {{$record->staff->last_name}}
                    </p>
                        <a class="form-control btn btn-warning" href="{{route('security_assignment.change_staff', ['id' => $record->id])}}">change</a>
                    @endforeach
            @else
                <label for="staff">Security Officer</label>
                <p class="form-control">Currently no staff in charge this job.</p>
            @endif
        </div>
        <a type="button" class="btn btn-danger" href="{{route('security_assignment.index')}}">Back</a>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
