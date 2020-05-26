@extends('Client.layout')
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="#">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
@section('mainContent')
    <form class="mx-auto w-75 my-5">
        <div class="form-row">
            <div class="col">
                <div class="form-row w-25">
                    <div class="col">
                        <label for="officerType">Officer Type</label>
                        <select class="form-control" id="officeType" onchange="overviewType(this.value);">
                            <option>Bouncer</option>
                            <option>Commissioned Officer</option>
                            <option>Non-Commisioned Officer</option>
                            <option>Remote CCTV Monitor</option>
                            <option>Uniformed Security</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="number">Number of Officers Required</label>
                        <input type="range" class="custom-range" min="0" max="5" id="number" onchange="updateTextInput(this.value);">
                        <input type="text" id="textInput" value="">
                    </div>
                </div>
                <div class="form-group my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Use Cureent Address
                        </label>
                    </div>
                    <div class="form-group row w-50 my-4">
                        <label for="street" class="col-sm-2 col-form-label">Street</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="street" name="street">
                        </div>
                    </div>
                    <div class="form-group row w-50">
                        <label for="suburb" class="col-sm-2 col-form-label">Suburb</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control w-75" id="suburb" name="suburb">
                        </div>
                    </div>
                    <div class="form-group row w-50">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-50" id="city" name="city">
                        </div>
                    </div>
                    <div class="form-group row w-75">
                        <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" id="postcode" name="postcode">
                        </div>
                    </div>
                    <button class="btn btn-primary my-1" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Set date and time
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body w-50">
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
                                                Collapsible Group Item #1
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Select Start Date
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
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Select End date or Ongoing
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
                            <label for="type" class="col col-form-label">Assignment Type</label>
                            <input type="text" class="border-0" id="type" name="type" value="">
                        </div>
                        <div class="form-row">
                            <label for="textinput" class="col col-form-label">Number of Guard</label>
                            <input type="text" class="border-0" id="textinput" name="textinput" value="">
                        </div>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>

        </div>

    </form>
@endsection
