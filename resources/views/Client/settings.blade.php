@extends('Client.layout')
@section('nav')
    <a href="{{route('client.dashboard')}}" id="profileBtn"><img  src="{{url('images/Dashboard_active.png')}}" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 " id="collapsingNavbar3">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{route('client.security')}}" >Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.property')}}">Property Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('client.jobs')}}">Service Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.bookings')}}">Security Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.quotes')}}">Quotes</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('client.settings')}}">Settings</a>
            </li>
        </ul>
    </div>
@endsection
@section('mainContent')
<div class="row">
    <div class="container ml-3">
        <div class="profile-card-col" style="min-height: 670px">
            <div  class="profile-id-card card bg-light shadow p-3 mb-2 border-0 card-image float-none rounded-lg shadow col-sm-0" style="background-image: url({{url('images/Card_BG.jpg')}}); ">
                <div id="cardHeader" class="card-header bg-light border-0 rounded">
                    <img class="w-100 align-top" src="{{url('images/Card_Header.png')}}" alt="Card top">
                </div>
                <img id="card-img-top" class="card-img-top rounded-circle border-light shadow border-3 mr-auto ml-auto mb-auto" src="{{isset($client->imgPath) ? url($client->imgPath): url('images/Profile_Placeholder_Large.png')}}" alt="Card image cap">
                <div class="mt-4 card-body text-light">
                    <h5 class="card-title text-center">{{$client->first_name}} {{$client->last_name}}</h5>
                    <h5 class="card-title text-center">Ph: {{$client->phone_number}}</h5>
                </div>

                <div class="card-footer bg-dark rounded">
                    <img class="w-100 align-top" src="{{url('images/KaiparaLogo.png')}}" alt="Card top">
                </div>
            </div>
        </div>
        <div style="width:74%; float: left; padding-left: 20px">

            <h2 class="text-center">Your Information</h2>
            <div class="container py-3 px-4 jumbotron bg-light" id="schedule">
                <form method="POST" action="{{route('client.postEdit')}}" class="needs-validation">
                    @csrf
                    <div class="row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>ID#:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" class="form-control-plaintext" value="{{$client->id}}" readonly>
                            </label>
                        </div>
                        <div class="col-1">
                        </div>
                    </div>
                    <div class="row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>First Name:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" class="form-control-plaintext" value="{{$client->first_name}}" readonly>
                            </label>
                        </div>
                        <div class="col-1">

                        </div>
                    </div>
                    <div class="row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>Last Name:</strong>
                        </div>
                        <div class="col-8">
                            <label>                            </label>
                                <input type="text" class="form-control-plaintext" value="{{$client->last_name}}" readonly>

                        </div>
                        <div class="col-1">

                        </div>
                    </div>
                    <div class="row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-8">
                            <label>                            </label>
                                <input type="text" class="form-control-plaintext" value="{{$client->email}}" readonly>

                        </div>
                        <div class="col-1">

                        </div>
                    </div>
                    <div class="row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>Phone Number:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" id="editPhoneNumber" name="pNumber" class="form-control form-control-plaintext can-edit" value="{{$client->phone_number}}" readonly required>
                            </label>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-pencil text-secondary edit-toggle" data-target="editPhoneNumber" title="edit"></i>
                        </div>
                    </div>
                    <div class="row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>Street:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" id="editStreet" name="street" class="form-control form-control-plaintext can-edit" value="{{$client->street}}" readonly required>
                            </label>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-pencil text-secondary edit-toggle" data-target="editStreet" title="edit"></i>
                        </div>
                    </div>
                    <div class=" row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>Suburb:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" id="editSuburb" name="suburb" class="form-control form-control-plaintext can-edit" value="{{$client->suburb}}" readonly required>
                            </label>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-pencil text-secondary edit-toggle" data-target="editSuburb" title="edit"></i>
                        </div>
                    </div>
                    <div class=" row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>City:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" id="editCity" name="city" class="form-control form-control-plaintext can-edit" value="{{$client->city}}" readonly required>
                            </label>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-pencil text-secondary edit-toggle" data-target="editCity" title="edit"></i>

                        </div>
                    </div>
                    <div class=" row  border-bottom">
                        <div class="py-2 col-3">
                            <strong>Postcode:</strong>
                        </div>
                        <div class="col-8">
                            <label>
                                <input type="text" pattern="\d*" id="editPostCode" name="postcode" class="form-control form-control-plaintext can-edit" minlength="4" maxlength="4" value="{{$client->postcode}}" readonly required>
                            </label>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-pencil text-secondary edit-toggle" data-target="editPostCode" title="edit"></i>
                        </div>
                    </div>
                    <div class="mt-2 row w-100">
                        <div class="col-3">
                            <a href="">Change your password</a>
                        </div>
                        <div class="col-9">
                            <input type="submit" id="btnEditClient" class="btn btn-success disabled float-right" value="Save Changes" style="pointer-events: none">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

