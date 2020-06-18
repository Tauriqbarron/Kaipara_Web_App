@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1 class="ml-5">Update property service assignment</h1>
        <h2 class="ml-5">Property service assignment id: {{$assignment->id}}</h2>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <hr/>

        <form class="ml-2" method="post" action="{{route('admin.service.edit', ['id' => $assignment->id])}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="client_id">Client ID</label>
                    <input class="form-control" value="{{$assignment->client->first_name}} {{$assignment->client->last_name}}" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="booking_type">Title:</label>
                    <input type="text" name="title" class="form-control" value="{{$assignment->title}}">
                </div>
                <div class="form-group col-md-4">
                    <label>Job type:</label>
                    <select class="form-control" name="job_type">
                        @foreach($types as $type)
                            @if($type->id == $assignment->job__type_id)
                                <option value="{{$type->id}}" selected="selected">{{$type->description}}</option>
                            @else
                                <option value="{{$type->id}}">{{$type->description}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="price">Price:</label>
                    @if($assignment->price == null)
                        <input type="text" class="form-control" name="price" placeholder="No price currently">
                    @else
                        <input type="text" class="form-control" name="price" value="{{$assignment->price}}">
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Quote:</label>
                    @if(App\quote::where('job_id', '=', $assignment->id)->exists())
                        <input class="form-control" value="quoted" disabled>
                    @else
                        <input class="form-control" value="unquoted" disabled>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="descripyion">Description:</label>
                <textarea type="text" class="form-control" name="description" rows="3">{{$assignment->description}}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Start Date:</label>
                    <input type="date" name="date" class="form-control" value="{{$assignment->date}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="date">End Date:</label>
                    @if($assignment->end_date != null)
                        <input type="date" name="end_date" class="form-control" value="{{$assignment->end_date}}">
                    @else
                        <input type="date" name="end_date" class="form-control" placeholder="Processing">
                    @endif
                </div>
                <div class="form-group col-9">
                    <label for="inputAddress2">Street:</label>
                    <input name="street" class="form-control" value="{{$assignment->street}}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity">Suburb:</label>
                    <input name="suburb" class="form-control" value="{{$assignment->suburb}}" />
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">City:</label>
                    <input name="city" class="form-control" value="{{$assignment->city}}" />
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip:</label>
                    <input name="postcode" class="form-control" value="{{$assignment->postCode}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputAddress2">Service Provider:</label>
                    @if($assignment->service_provider_job != null)
                    <input class="form-control" value="{{$assignment->service_provider_job->service_provider->firstname}} {{$assignment->service_provider_job->service_provider->lastname}}" disabled>
                    @else
                        <input class="form-control" value="This assignment is currently available." disabled>
                    @endif

            </div>
            <div class="form-group">
                <label for="inputAddress2">Status:</label>
                @if($assignment->status == 1)
                    <input class="form-control" value="available" disabled>
                @elseif($assignment->status == 2)
                    <input class="form-control" value="accepted" disabled>
                @elseif($assignment->status == 3)
                    <input class="form-control" value="started" disabled>
                @elseif($assignment->status == 4)
                    <input class="form-control" value="completed" disabled>
                @endif
            </div>

            <a type="button" class="btn btn-danger" href="{{URL::previous()}}">Back</a>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>


@endsection
