@extends('Profile.layout')





@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{ url('/service/applications')}}">Applications</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{ url('/service/jobs')}}">Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Availability Schedule</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Profile</a>
@endsection
