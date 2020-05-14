@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Security assignment id: {{$assignment->id}}</h1>
    <hr/>
    <form class="ml-2">
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

        {{$staff_ids = App\Staff_Assignment::where(['booking_id' => $assignment->id])->pluck('staff_id')}}
        @foreach($staff_ids as $staff_id)
        <div class="form-group">
            <label for="inputAddress2">Security Officer</label>
            <p class="form-control">
                {{App\Staff::where(['id' => $staff_id])->pluck('first_name')->first()}}
                {{App\Staff::where(['id' => $staff_id])->pluck('last_name')->first()}}
            </p>
        </div>
        @endforeach
        <div class="form-group">
            <label for="inputAddress2">Status</label>
            <p class="form-control">{{$assignment->status}}</p>
        </div>
        <a class="btn btn-danger" href="{{route('security_assignment.index')}}">back</a>
    </form>
@endsection
