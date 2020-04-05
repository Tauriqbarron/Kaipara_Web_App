@extends('Administration.layout')

@section('mainContent')
    <h1 class="ml-5">Staff id: {{ $staff->id }}</h1>
    <hr/>
    <div class="row ml-5">
        <div class="col-md-4">
            <form method="post" action="{{route('staff.edit', ['id'=>$staff->id])}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">First Name</label>
                    <input name="fName" class="form-control" value="{{$staff->first_name}}" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Last Name</label>
                    <input name="lName" class="form-control" value="{{$staff->last_name}}" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Email</label>
                    <input name="email" class="form-control" value="{{$staff->email}}" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Phone Number</label>
                    <input name="pNumber" class="form-control" value="{{$staff->phone_number}}" />
                </div>
                <div class="form-group">
                    <a type="button" class="btn btn-danger float-left" href="{{route('staff.index')}}">Back</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
