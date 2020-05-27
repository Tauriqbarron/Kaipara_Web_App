@extends('Client.layout')


@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.security')}}">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.property')}}">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
