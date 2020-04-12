@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Staff id: {{ $staff->id }}</h1>
    <hr/>
    <div class="row ml-5">
        <div class="col-md-4">
            <form method="post" action="{{route('staff.delete', ['id'=>$staff->id])}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">First Name</label>
                    <p class="form-control">{{$staff->first_name}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Last Name</label>
                    <p class="form-control">{{$staff->last_name}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Email</label>
                    <p class="form-control">{{$staff->email}}</p>
                </div>
                <div class="form-group">
                    <label  class="control-label">Phone Number</label>
                    <p class="form-control">{{$staff->phone_number}}</p>
                </div>
                <div class="form-group">
                    <a type="button" class="btn btn-primary float-left" href="{{route('staff.index')}}">Back</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection
