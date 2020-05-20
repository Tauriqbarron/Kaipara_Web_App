@extends('Administration.layout')
@section('mainContent')
    <h1 class="ml-5">Security assignment id: {{$staff_assignment->booking_id}}</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <hr/>
    <a class="btn btn-danger ml-2" href="{{route('security_assignment.edit', ['id' => $staff_assignment->booking_id])}}">Back</a>
    <br/>
    <br/>

            <form class="ml-2" method="post" action="{{route('security_assignment.change_staff', ['id' => $staff_assignment->id])}}">
                @csrf
                <div class="form-group col-md-2">
                    <label for="staff">Security Officer</label>
                    <select class="form-control" name="staff">
                        @foreach($staffs as $staff)
                            @if($staff->id == $staff_assignment->staff_id)
                                <option value="{{$staff->id}}" selected="selected">
                                    {{$staff->first_name}}
                                    {{$staff->last_name}}
                                </option>
                            @else
                                <option value="{{$staff->id}}">
                                    {{$staff->first_name}}
                                    {{$staff->last_name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="form-control col-md-2 btn btn-success">change</button>
            </form>

@endsection
