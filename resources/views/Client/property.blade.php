@extends('Client.layout')
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.security')}}">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="#">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
@section('mainContent')
    <h2 class="w-100 text-center mb-5">Book a Job </h2>
    <form class="mx-auto needs-validation" novalidate method="POST" action="{{route('client.postCreateBooking')}}">
        @csrf
        <div class="form-row">
            <div class="col mr-5">
                <div class="form-row">
                    <div class="col">
                        <label for="serviceType"><h4>Service Type</h4></label>
                        <select class="form-control w-50" id="serviceType" onchange="overviewType(this.value);" required>
                            <option>Plumbing</option>
                            <option>Electrical</option>
                            <option>Landscaping</option>
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
                        <textarea id="message" name="message" rows="6" cols="30" class="form-control" maxlength="300" placeholder="The cat was playing in the garden." onchange="document.getElementById('description').innerHTML = this.value" required></textarea>
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
                            <input type="text" class="form-control address-input" data-input="street" id="streetInput" name="street" onchange="overviewStreet(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">Suburb</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input w-75" data-input="suburb" id="suburbInput" name="suburb" onchange="overviewSuburb(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">City</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input w-50" data-input="city" id="cityInput" name="city" onchange="overviewCity(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label class="col-sm-2 col-form-label">Postcode</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control address-input w-25" data-input="postcode" id="postcode" name="postcode" minlength="4" maxlength="4" pattern="\d*" onchange="overviewPostcode(this.value);" required>
                        </div>
                    </div>
                </div>
                {{--Date Options--}}
                <div class="form-row">
                    <div class="col">
                        <label for="startDateInput">Select Start Date <small class="font-italic text-dark">(optional)</small></label>
                        <input class="form-control" type="date" id="startDateInput" min="{{\Carbon\Carbon::parse(today()->addDay())->format('Y-m-d')}}" onchange="overviewDate(this.value)">
                    </div>
                </div>
                {{--Price Options--}}
                <div class="form-row">
                    <div class="col">
                        <label for="priceInput">Set a price</label>
                        <input class="form-control w-50" max="1000000" min="1" type="number" id="priceInput" onchange="overviewPrice(this.value)" required>
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
            <div class="col">
                <div class="card bg-light float-right w-75">
                    <div class="card-header">
                        Booking Details
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
                                    <input type="text" class="col-7 form-control-plaintext " id="startDate" name="startDate" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="price" class="col-5 col-form-label text-primary">Price </label>
                            <input type="text" class="col-7 form-control-plaintext " id="price" name="price" value="" readonly>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Confirm Booking"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
