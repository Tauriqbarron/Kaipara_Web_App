@extends('Administration.layout')

@section('mainContent')
    <h1>Staff Management</h1>
    <p>
        <a href="{{route('staff.create')}}" class="btn btn-primary ml-2">Create</a>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone number</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($staffs as $staff)
            <tr>
                <td>{{$staff->id}}</td>
                <td>{{$staff->first_name}}</td>
                <td>{{$staff->last_name}}</td>
                <td>{{$staff->email}}</td>
                <td>{{$staff->phone_number}}</td>
                <td><a class="btn btn-primary" href="{{route('staff.edit', ['id' => $staff->id])}}">Edit</a></td>
                <td><a class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection
