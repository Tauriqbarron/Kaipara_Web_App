@extends('Administration.layout')
@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Update assignment</h1>
    <h2 class="ml-5">Security assignment id: {{$assignment->id}}</h2>
    <hr/>

    <form class="ml-2" method="post" action="{{route('security_assignment.edit', ['id' => $assignment->id])}}">

        @csrf
        <!--The client name and the type of this assignment-->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client_id">Client Name:</label>
                <input name="client_id" class="form-control" value="{{$assignment->client->first_name}} {{$assignment->client->last_name}}" disabled>
            </div>
            <div class="form-group col-md-6">
                <label for="booking_type">Assignment type:</label>
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

            <div class="form-group col-md-4">
                <label for="price">Price:</label>
                <input class="form-control @error('price') is-invalid @enderror" name="price" value="{{$assignment->price}}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{$assignment->description}}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Start Date:</label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{$assignment->date}}">
                @error('date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="date">End date:</label>
                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{$assignment->end_date}}">
                @error('end_date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="start_time">Start Time:</label>
                <input type="text" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{$assignment->start_time}}">
                @error('start_time')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="finish_time">End Time:</label>
                <input type="text" name="finish_time" class="form-control @error('finish_time') is-invalid @enderror" value="{{$assignment->finish_time}}">
                @error('finish_time')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

            <div class="form-group w-25">
                <label for="inputAddress2">Status:</label>
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

            <div class="form-group">
                <label for="street">Street</label>
                <input name="street" class="form-control @error('street') is-invalid @enderror" value="{{$assignment->street}}" />
                @error('street')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="suburb">Suburb</label>
                    <input name="suburb" class="form-control @error('suburb') is-invalid @enderror" value="{{$assignment->suburb}}" />
                    @error('suburb')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input name="city" class="form-control @error('city') is-invalid @enderror" value="{{$assignment->city}}" />
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="postcode">Zip</label>
                    <input name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{$assignment->postcode}}" />
                    @error('postcode')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <!--The date, time, number of staff and the address-->
                <div class="form-group w-25">
                    <label for="numOfStaff">Number of Officer:</label>
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

        <!--Change staff-->
        <div class="form-group w-25">
            @if(\App\Staff_Assignment::where('booking_id', '=', $assignment->id)->exists())
                    @foreach($assignment->staff_assignments as $record)
                    <label for="inputAddress2">Security Officer:</label>
                    <p class="form-control">
                        {{$record->staff->first_name}}
                        {{$record->staff->last_name}}
                    </p>
                        <a class="form-control btn btn-warning" href="{{route('security_assignment.change_staff', ['id' => $record->id])}}">change</a>
                    @endforeach
            @else
                <label for="staff">Security Officer:</label>
                <p class="form-control">Currently no staff in charge this job.</p>
            @endif
        </div>

        <a type="button" class="btn btn-danger" href="{{route('security_assignment.index')}}">Back</a>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
    </div>
@endsection
