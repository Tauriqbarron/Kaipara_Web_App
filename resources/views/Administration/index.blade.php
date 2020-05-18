@extends('Administration.layout')

@section('mainContent')
    <h1>Welcome to administration center</h1>
    <a href="{{route('security_assignment.index')}}"><button type="button" class="btn btn-primary btn-lg">Assignment Management</button></a>
    <a href="{{route('staff.index')}}"><button type="button" class="btn btn-primary btn-lg">Staff Management</button></a>
    <a href="{{route('client.index')}}"><button type="button" class="btn btn-primary btn-lg">Client Management</button></a>
    <a href="{{route('sp.index')}}"><button type="button" class="btn btn-primary btn-lg">Service Provider Management</button></a>
@endsection
