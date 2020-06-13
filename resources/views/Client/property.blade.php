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
    <form class="mx-auto">
        <div class="form-row">
            <div class="col mr-5">
                <div class="form-row">
                    <div class="col">
                        <label for="serviceType"><h4>Service Type</h4></label>
                        <select class="form-control w-50" id="serviceType" onchange="">
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
                        <textarea id="message" name="message" rows="6" cols="30" class="form-control" maxlength="300">The cat was playing in the garden.</textarea>
                    </div>
                </div>
                <div class="form-group my-3">
                    <div class="col form-check">

                        {{--
                                                TODO create function to display address of user in summary tab is checked
                        --}}
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Use Current Address
                        </label>
                    </div>
                    <div class="form-group row my-4">
                        <div class="col-3">
                            <label for="streetInput" class="col-sm-2 col-form-label">Street</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" id="streetInput" name="street" onchange="overviewStreet(this.value);">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-3">
                            <label for="suburbInput" class="col-sm-2 col-form-label">Suburb</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control w-75" id="suburbInput" name="suburb" onchange="overviewSuburb(this.value);">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-3">
                            <label for="cityInput" class="col-sm-2 col-form-label">City</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control w-50" id="cityInput" name="city" onchange="overviewCity(this.value);">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control w-25" id="postcode" name="postcode" minlength="4" maxlength="4" pattern="/4d" onchange="overviewPostcode(this.value);">
                        </div>
                    </div>
                    <button class="btn btn-primary my-4" type="button" data-toggle="collapse" data-target="#custom" aria-expanded="false" aria-controls="custom">
                        Create Custom Schedule
                    </button>
                    <div class="collapse w-100" id="custom">
                        <div class="card card-body ">
                            <div id="accordion">
                                <div class="row">
                                    <div class="card w-100">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Select Days
                                                </button>
                                            </h5>
                                        </div>
                                        {{-- TODO create overview for custom schedule build & add start/end time to day picker --}}
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col">
                                                        @foreach(array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') as $record)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="{{$record}}" id="defaultCheck{{$record}}">
                                                                <label class="form-check-label" for="defaultCheck{{$record}}">
                                                                    {{$record}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                            <label class="form-check-label" for="defaultCheck1">
                                                                Ongoing
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card w-100">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Or Select A Date and Time
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="birthday">Select Date</label>
                                                        <input type="date" min="{{today('NZ')->addDay()}}" id="birthday" name="birthday">
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="appt">Select Start time:</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="time" id="appt" name="appt">
                                                            </div>
                                                        </div>
                                                        <div class="form-row my-2">
                                                            <div class="col">
                                                                <label for="appt">Select End time:</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="time" id="appt" name="appt">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card w-100">
                                        <div class="card-header" id="headingThree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Or Select a due date
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="birthday">Select Date</label>
                                                        <input type="date" id="birthday" name="birthday" min="{{(today('NZ')->addDay())}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Booking Details
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <label for="type" class="col col-form-label text-primary">Job Type</label>
                            <input type="text" class="border-0" id="type" name="type" value="Plumbing" readonly>
                        </div>
                        <div class="form-row">
                            <label for="type" class="col col-form-label text-primary">Description</label>
                            <input type="text" class="border-0" id="description" name="description" value="" readonly>
                        </div>
                        <div class="form-row ">
                            <label for="street" class="col col-form-label text-primary">Address</label>
                        </div>
                        <div class="form-row ml-5">
                            <div class="col">
                                <input type="text" class="border-0" id="street" name="street" value="" readonly>
                            </div>
                            <div class="col">
                                <input type="text" class="border-0" id="suburb" name="suburb" value="" readonly>
                            </div>
                        </div>
                        <div class="form-row ml-5">
                            <div class="col">
                                <input type="text" class="border-0" id="city1" name="city1" value="" readonly>
                            </div>
                            <div class="col">
                                <input type="text" class="border-0" id="postcode1" name="postcode1" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
