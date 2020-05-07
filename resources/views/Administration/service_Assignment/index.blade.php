@extends('Administration.layout')

@section('mainContent')
    <h1>Security Assignment Management</h1>
    <form style="padding-top: 25px;" class="form-inline my-2 my-lg-3 ml-2" method="get" action="#">
        <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <div>
        <a href="#" class="btn btn-primary ml-2">Create</a>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Booking Type</th>
                <th>Client name</th>
                <th>Staff name</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($assignments as $assignment)
            <tr>
                <td>{{$assignment->Booking->id}}</td>
                <td>{{App\Booking_Types::where(['id' => $assignment->Booking->booking_type_id])->pluck('description')->first()}}</td>
                <td>
                    {{App\Clients::where(['id' => $assignment->Booking->client_id])->pluck('first_name')->first()}}
                    {{App\Clients::where(['id' => $assignment->Booking->client_id])->pluck('last_name')->first()}}
                </td>
                <td>{{$assignment->Staff->first_name}} {{$assignment->Staff->last_name}}</td>
                <td><a class="btn btn-success" href="#">view</a></td>
                <td><a class="btn btn-primary" href="#">Edit</a></td>
                <td><a class="btn btn-danger" href="#">Delete</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
