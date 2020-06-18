@extends('Client.layout')
@section('nav')
    <a href="{{route('client.dashboard')}}" id="profileBtn"><img  src="{{url('images/Dashboard_active.png')}}" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 " id="collapsingNavbar3">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{route('client.security')}}" >Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('client.property')}}">Property Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Service Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.bookings')}}">Security Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Quotes</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
            </li>
        </ul>
    </div>
@endsection
@section('mainContent')

    <form class="mx-auto needs-validation" novalidate method="POST" action="{{route('client.postCreateApplication')}}">
        @csrf
        <div class="form-row mr-0">
            <div class="col-7 pr-5">
                <h2 class="w-100 text-center mb-5">Book a Job </h2>
                <div class="form-row">
                    <div class="col">
                        <label for="titleInput"><h4>Title</h4></label>
                        <input class="form-control" type="text" autocomplete="off" id="titleInput" maxlength="50" placeholder="Eg. 200m Fence, 5 Meter Paving etc" onchange="overviewTitle(this.value)" required>
                    </div>
                    <div class="col">
                        <label for="serviceType"><h4>Service Type</h4></label>
                        <select class="form-control w-100" id="serviceType" onchange="overviewType(this);" required>
                            @foreach($job_types as $type)
                                <option>{{$type->description}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row my-2">
                    <div class="col">
                        <label for="message"><h4>Description</h4> </label>
                    </div>

                </div>
                <div class="form-row my-2">
                    <div class="col">
                        <textarea id="message"rows="6" cols="30" class="form-control" maxlength="300" placeholder="The cat was playing in the garden." onchange="document.getElementById('description').innerHTML = this.value" required></textarea>
                    </div>
                </div>
                <div class="form-group my-3">
                    <div class="col form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" data-street="{{auth()->guard('client')->user()->street}}" data-suburb="{{auth()->guard('client')->user()->suburb}}" data-city="{{auth()->guard('client')->user()->city}}" data-postcode="{{auth()->guard('client')->user()->postcode}}" >
                        <label class="form-check-label" for="gridCheck">
                            Use Current Address
                        </label>
                    </div>
                    <div class="form-group row my-4">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">Street</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input" data-input="street" id="streetInput" onchange="overviewStreet(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">Suburb</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input w-75" data-input="suburb" id="suburbInput" onchange="overviewSuburb(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">City</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input w-50" data-input="city" id="cityInput" onchange="overviewCity(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">Postcode</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input w-25" data-input="postcode" id="postcode" minlength="4" maxlength="4" pattern="\d*" onchange="overviewPostcode(this.value);" required>
                        </div>
                    </div>
                </div>
                {{--Date Options--}}
                <div class="form-row">
                    <div class="col">
                        <label for="startDateInput">Select Start Date <small class="font-italic text-dark">(optional)</small></label>
                        <input class="form-control w-50" type="date" id="startDateInput" min="{{\Carbon\Carbon::parse(today()->addDay())->format('Y-m-d')}}" onchange="overviewDate(this.value)">
                    </div>
                </div>
                {{--Price Options--}}
                <div class="form-row">
                    <div class="col">
                        <label for="priceInput">Set a price</label>
                        <input class="form-control w-25" max="1000000" min="1" type="number" id="priceInput" onchange="overviewPrice(this.value)" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col btn-group-toggle pt-4">
                        <label class="btn btn-primary">
                            <input class="form-check" type="checkbox" onclick="overviewQuote(this.checked)">Request a Quote
                        </label>
                    </div>
                </div>
            </div>
            {{------------------------------------------}}
            {{------------------------------------------}}
            {{---------------Overview-------------------}}
            {{------------------------------------------}}
            {{------------------------------------------}}
            <div class="col-5 px-5 bg-light rounded-bottom rounded-left-0 py-5" style="margin-top: -47px; margin-bottom: -64px;">
                <div class="card border-0 shadow bg-white w-100 rounded-lg">
                    <div class="card-header border-0 bg-white text-center">
                        <h3 class="mb-0" id="txtTitleDisplay">Booking Details</h3>
                        <input type="hidden" id="txtTitle" name="title" required>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <label for="type" class="col-5 col-form-label text-primary">Job Type</label>
                            <input type="text" class="col-7 form-control-plaintext" id="type" name="type" value="Plumbing" readonly>
                        </div>
                        <div class="form-row">
                            <label for="type" class="col-5 col-form-label text-primary">Description</label>
                            <textarea type="text" class="col-7 form-control-plaintext" id="description" name="description" readonly></textarea>
                        </div>
                        <div class="form-row ">
                            <label for="street" class="col-5 col-form-label text-primary">Address</label>

                            <div class="col-7">
                                <div class="form-row">
                                    <input type="text" class="form-control-plaintext " id="street" name="street" value="" readonly>
                                </div>
                                <div class="form-row">
                                    <input type="text" class="form-control-plaintext " id="suburb" name="suburb" value="" readonly>
                                </div>
                                <div class="form-row">
                                    <input type="text" class="form-control-plaintext " id="city1" name="city1" value="" readonly>
                                </div>
                                <div class="form-row">
                                    <input type="text" class="form-control-plaintext " id="postcode1" name="postcode1" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="rowDateOverview">
                            <label for="startDate" id="lblDateHeading" class="col-5  col-form-label text-primary">Date</label>
                            <div id="ovDateCol" class="col-7">
                                <div class="form-row">
                                    <input type="text" class="col-7 form-control-plaintext " id="txtStartDate" name="startDate" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="txtPrice" class="col-5 col-form-label text-primary">Price </label>
                            <input type="text" class="col-7 form-control-plaintext " id="txtPrice" value="" readonly>
                            <input type="hidden" class="col-7 form-control-plaintext " id="price" name="price" value="" readonly>
                        </div>
                        <input type="submit" class="btn btn-primary w-100" value="Confirm Booking"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
