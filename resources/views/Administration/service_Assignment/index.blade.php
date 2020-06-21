@extends('Administration.layout')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@section('mainContent')
    <h1>Property Service Assignment Management</h1>
    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <form style="padding-top: 25px;" class="form-inline my-2 my-lg-3 ml-2" method="get" action="{{route('admin.service.search')}}">
        <input name="search" class="form-control mr-sm-2" type="search" placeholder="Assignment or client id" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <div>
        <a href="{{route('admin.service.create')}}" class="btn btn-primary ml-2">Create</a>
        <table class="table mt-1">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Title</th>
                <th>Client Name</th>
                <th>Date</th>
                <th>Price</th>
                <th>Status</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($assignments as $assignment)
                <tr class="table-secondary text-center">
                    <td>{{$assignment->id}}</td>
                    <td>{{$assignment->title}}</td>
                    <td>
                        {{$assignment->client->first_name}}
                        {{$assignment->client->last_name}}
                    </td>
                    <td>{{$assignment->date}}</td>
                    <td>{{$assignment->price}}</td>
                    @if($assignment->status == 1)
                        <td>available</td>
                    @elseif($assignment->status == 2)
                        <td>accepted</td>
                    @elseif($assignment->status == 3)
                        <td>started</td>
                    @elseif($assignment->status == 4)
                        <td>completed</td>
                    @endif
                    <td><a class="btn btn-success" href="{{route('admin.service.view', ['id' => $assignment->id])}}">view</a></td>
                    <td><a class="btn btn-primary" href="{{route('admin.service.edit', ['id' => $assignment->id])}}">Edit</a></td>
                    <td><a class="btn btn-danger" href="{{route('admin.service.delete', ['id' => $assignment->id])}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="float-right mr-1">
        {!! $assignments->links() !!}
    </div>
@endsection
