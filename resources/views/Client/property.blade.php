@extends('Client.layout')
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.security')}}">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="#">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
@section('mainContent')
    <form class="mx-auto w-75 my-5">
        <div
        <div class="col">
            <h3>Book a Job </h3>
            <div class="form-row w-25 my-5">
                <div class="col">
                    <label for="officerType"><h4>Officer Type</h4></label>
                    <select class="form-control" id="officeType" onchange="">
                        <option>Plumbing</option>
                        <option>Electrical</option>
                        <option>Landscaping</option>
                    </select>
                </div>
            </div>
            <div class="form-group my-3">
                <div class="form-check">

                    {{--
                                            TODO create function to display address of user in summary tab is checked
                    --}}
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Use Cureent Address
                    </label>
                </div>
                <div class="form-group row w-50 my-4">
                    <label for="street" class="col-sm-2 col-form-label">Street</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="streetInput" name="street" onchange="overviewStreet(this.value);">
                    </div>
                </div>
                <div class="form-group row w-50">
                    <label for="suburb" class="col-sm-2 col-form-label">Suburb</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-75" id="suburbInput" name="suburb" onchange="overviewSuburb(this.value);">
                    </div>
                </div>
                <div class="form-group row w-50">
                    <label for="city" class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50" id="city" name="city" onchange="overviewCity(this.value);">
                    </div>
                </div>
                <div class="form-group row w-75">
                    <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-25" id="postcode" name="postcode" onchange="overviewPostcode(this.value);">
                    </div>
                </div>
                <button class="btn btn-primary my-4" type="button" data-toggle="collapse" data-target="#custom" aria-expanded="false" aria-controls="custom">
                    Create Custom Schedule
                </button>
                <div class="collapse" id="custom">
                    <div class="card card-body w-50">
                        <div id="accordion">
                            <div class="card">
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
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Monday
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Tuesday
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Wednesday
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Thursday
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Friday
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Saturday
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Sunday
                                                    </label>
                                                </div>
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
                            <div class="card">
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
                                                <input type="date" id="birthday" name="birthday">
                                            </div>
                                            <div class="col">
                                                <div class="form-row">
                                                    <label for="appt">Select Start time:</label>
                                                    <input type="time" id="appt" name="appt">
                                                </div>
                                                <div class="form-row my-2">
                                                    <label for="appt">Select End time:</label>
                                                    <input type="time" id="appt" name="appt">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
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
                                                <input type="date" id="birthday" name="birthday">
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
            </div>
        </div>

    </form>
@endsection
