@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1>Assignment detail</h1>
    <h2 class="ml-5">Property service assignment id: {{$assignment->id}}</h2>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
    <hr/>
    <form class="ml-2" method="post" action="{{route('admin.service.delete', ['id' => $assignment->id])}}">
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
                <label for="inputPassword4">Assignment Title</label>
                <p class="form-control">{{$assignment->title}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="job_type">Job type:</label>
                <p name="job_type" class="form-control">{{$assignment->job_type->description}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Description</label>
            <p class="form-control">{{$assignment->description}}</p>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputAddress2">Price</label>
                <p class="form-control">{{$assignment->price}}</p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress2">Quote</label>
                @if(App\quote::where('job_id', '=', $assignment->id)->exists())
                <p class="form-control">quoted</p>
                    @else
                    <p class="form-control">unquoted</p>
                    @endif
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <p name="date" class="form-control">{{$assignment->date}}</p>
            </div>
            <div class="form-group col-md-6">
                <label for="date">End date:</label>
                <p name="end_date" class="form-control">{{$assignment->end_date}}</p>
            </div>
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
                <p class="form-control">{{$assignment->postCode}}</p>
            </div>
        </div>

        <div class="form-group">
            <label for="inputAddress2">Service Provider</label>
            <p class="form-control">
                @if($assignment->service_provider_job != null)
                    {{$assignment->service_provider_job->service_provider->firstname}}
                    {{$assignment->service_provider_job->service_provider->lastname}}
                @else
                    This assignment is currently available.
                @endif

            </p>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Status</label>
            @if($assignment->status == 1)
                <p class="form-control">available</p>
            @elseif($assignment->status == 2)
                <p class="form-control">accepted</p>
            @elseif($assignment->status == 3)
                <p class="form-control">started</p>
            @elseif($assignment->status == 4)
                <p class="form-control">completed</p>
            @endif
        </div>
        <div class="float-right text-danger">Are you sure you want to delete this assignment record?</div>
        <br/>
        <br/>
        <a class="btn btn-success" href="{{URL::previous()}}">back</a>
        <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
    </div>
@endsection
