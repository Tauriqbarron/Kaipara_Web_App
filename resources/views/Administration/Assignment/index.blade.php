@extends('Administration.layout')

@section('mainContent')
    <h1>Assignment Management</h1>
    <form style="padding-top: 25px;" class="form-inline my-2 my-lg-3 ml-2" method="get" action="#">
        <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <div>
        <a href="#" class="btn btn-primary ml-2">Create</a>

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>id</td>
                <td><a>The title</a></td>
            </tr>
            </tbody>

        </table>
    </div>
@endsection
