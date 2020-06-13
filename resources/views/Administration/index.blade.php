@extends('Administration.layout')

@section('mainContent')
    <div class="ml-2 mt-2">
    <h1>Welcome to administration center</h1>
    <hr/>
    <div class="row mx-md-n5">
        <a class="col px-md-5" href="{{route('security_assignment.index')}}">
            <button type="button" class="btn btn-outline-primary btn-lg">Assignment Management</button>
        </a>
        <a class="col px-md-5" href="{{route('staff.index')}}">
            <button type="button" class="btn btn-outline-primary btn-lg">Staff Management</button>
        </a>
        <a class="col px-md-5" href="{{route('client.index')}}">
            <button type="button" class="btn btn-outline-primary btn-lg">Client Management</button>
        </a>
        <a class="col px-md-5" href="{{route('sp.index')}}">
            <button type="button" class="btn btn-outline-primary btn-lg">Service Provider Management</button>
        </a>
    </div>
    </div>
@endsection
