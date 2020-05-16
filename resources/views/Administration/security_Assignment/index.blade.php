@extends('Administration.layout')

@section('mainContent')
    <h1>Security Assignment Management</h1>
    <form style="padding-top: 25px;" class="form-inline my-2 my-lg-3 ml-2" method="get" action="{{route('security_assignment.search')}}">
        <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <div>
        <a href="{{route('security_assignment.create')}}" class="btn btn-primary ml-2">Create</a>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Booking Type</th>
                <th>Description</th>
                <th>Client name</th>
                <th>Staff name</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($assignments as $assignment)
                <td>{{$assignment->id}}</td>
                <td>{{$assignment->booking_type->description}}</td>
                <td>{{$assignment->description}}</td>
                <td>
                    {{$assignment->client->first_name}}
                    {{$assignment->client->last_name}}
                </td>
                <td>{{$assignment->status}}</td>
                <td><a class="btn btn-success" href="{{route('security_assignment.view', ['id' => $assignment->id])}}">view</a></td>
                <td><a class="btn btn-primary" href="#">Edit</a></td>
                <td><a class="btn btn-danger" href="#">Delete</a></td>
                @if($assignment->status == 'available')
                    <td><a class="btn btn-warning" href="#">Assign</a></td>
                    @else
                        <td></td>
                    @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
