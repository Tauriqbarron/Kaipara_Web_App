@extends('Administration.layout')

@section('mainContent')
    <h1>Staff Management</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone number</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection
