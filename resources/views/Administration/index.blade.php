@extends('Administration.layout')

@section('mainContent')
    <h1>Welcome to administration center</h1>
    <a href="{{url('/admin/assignment')}}"><button type="button" class="btn btn-primary btn-lg">Assignment Management</button></a>
    <button type="button" class="btn btn-primary btn-lg">Staff Management</button>
    <button type="button" class="btn btn-primary btn-lg">Client Management</button>
    <button type="button" class="btn btn-primary btn-lg">Service Provider Management</button>

@endsection
