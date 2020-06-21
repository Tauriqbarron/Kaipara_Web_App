@extends('Administration.layout')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
@section('mainContent')
    <h1>Service provider management</h1>
    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <form style="padding-top: 25px;" class="form-inline my-2 my-lg-3 ml-2" method="get" action="{{route('sp.search')}}">
        <input name="search" class="form-control mr-sm-2" type="search" placeholder="id or name" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div>
        <a href="{{route('sp.create')}}" class="btn btn-primary ml-2">Create</a>

        <table class="table mt-1">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($sps as $sp)
                <tr class="table-secondary">
                    <td>{{$sp->id}}</td>
                    <td>{{$sp->firstname}}</td>
                    <td>{{$sp->lastname}}</td>
                    <td>{{$sp->email}}</td>
                    <td>{{$sp->phone_number}}</td>
                    <td><a class="btn btn-success" href="{{route('sp.view', ['id' => $sp->id])}}">View</a></td>
                    <td><a class="btn btn-primary" href="{{route('sp.edit', ['id' => $sp->id])}}">Edit</a></td>
                    <td><a class="btn btn-danger" href="{{route('sp.delete', ['id' => $sp->id])}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="float-right mr-1">
        {!! $sps->links() !!}
    </div>
@endsection
