@extends('Administration.layout')

@section('mainContent')
    <h1>Client Management</h1>
    <form style="padding-top: 25px;" class="form-inline my-2 my-lg-3 ml-2" method="get" action="#">
        <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

        <div>
            <a href="#" class="btn btn-primary ml-2">Create</a>

            <table class="table">
                <thead>
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
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->first_name}}</td>
                        <td>{{$client->last_name}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->phone_number}}</td>
                        <td><a class="btn btn-success" href="{{route('client.view', ['id' => $client->id])}}">View</a></td>
                        <td><a class="btn btn-primary" href="{{route('client.edit', ['id' => $client->id])}}">Edit</a></td>
                        <td><a class="btn btn-danger" href="#">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


@endsection
