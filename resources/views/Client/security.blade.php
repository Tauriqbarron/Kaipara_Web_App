@extends('Client.layout')
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="#">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.property')}}">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
@section('mainContent')
    <div class="jumbotron rounded-bottom bg-white">
        <form class="mx-auto my-5">
            <div class="form-row">
                <div class="col mr-5">
                    <div class="form-row">
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
                            <input type="range" class="custom-range" min="0" max="5" id="number" onchange="updateTextInput(this.value);overviewTextInput(this.value);">
                            <input type="text" id="textInput" value="3">
                        </div>
                    </div>
                    <div class="form-row my-1 mt-5">
                        <label for="message"><h4>Description</h4></label>
                    </div>
                    <div class="form-row my-1 mb-5">
                        <textarea name="message" rows="6" cols="30" class="w-75">The cat was playing in the garden.</textarea>
                    </div>
                    <div class="form-group my-3">
                        <div class="form-check">
    {{--
                            TODO create function to display address of user in summary tab is checked
    --}}
                            <div class="form-row my-1 mt-5">
                                <h4>Address</h4>
                            </div>
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Use Current Address
                            </label>
                        </div>
                        <div class="form-group row my-4">
                            <label for="street" class="col-sm-2 col-form-label">Street</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="streetInput" name="street" onchange="overviewStreet(this.value);">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="suburb" class="col-sm-2 col-form-label">Suburb</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control w-75" id="suburbInput" name="suburb" onchange="overviewSuburb(this.value);">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control w-50" id="city" name="city" onchange="overviewCity(this.value);">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control w-25" id="postcode" name="postcode" onchange="overviewPostcode(this.value);">
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
                                        <input type="date" id="birthday" name="birthday" onchange="overviewDate(this.value)">
                                    </div>
                                    <div class="col">
                                        <div class="form-row">
                                            <label for="appt">Select Start time:</label>
                                            <input type="time" id="appt" name="appt" onchange="overviewStart(this.value)">
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
                                                    Or Select Start and End date
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-row my-2">
                                                    <div class="col">
                                                        <label for="birthday">Select Date</label>
                                                        <input type="date" id="birthday" name="birthday">
                                                    </div>
                                                    <div class="col">
                                                        <label for="birthday">Select Date</label>
                                                        <input type="date" id="birthday" name="birthday">
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
                                                Finally Set Time
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-row">
                                                    <label for="appt">Select Start time:</label>
                                                    <input type="time" id="appt" name="appt" onchange="overviewStart(this.value)">
                                                </div>
                                                <div class="form-row my-2">
                                                    <label for="appt">Select End time:</label>
                                                    <input type="time" id="appt" name="appt" onchange="overviewEnd(this.value)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col" style="width: 50%">
                    <div class="card  bg-light float-right w-75">
                        <div class="card-header">
                            Booking Details
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <label for="type"  class="col-5 col-form-label text-primary">Assignment Type</label>
                                <input type="text" class="col-7 form-control-plaintext w-50" id="type" name="type" value="Bouncer" readonly>
                            </div>
                            <div class="form-row">
                                <label for="number1" class="col-5  col-form-label text-primary">Number of Guard</label>
                                <input type="text" class="col-7 form-control-plaintext " id="number1" name="number1" value="" readonly>
                            </div>
                            <div class="form-row ">
                                <label for="street" class="col col-form-label text-primary">Address</label>
                            </div>
                            <div class="form-row ml-5 my-1">
                                <input type="text" class="form-control-plaintext " id="street" name="street" value="" readonly>
                            </div>
                            <div class="form-row ml-5 my-1">
                                <input type="text" class="form-control-plaintext " id="suburb" name="suburb" value="" readonly>
                            </div>
                            <div class="form-row ml-5 my-1">
                                <input type="text" class="form-control-plaintext " id="city1" name="city1" value="" readonly>
                            </div>
                            <div class="form-row ml-5 my-1">
                                <input type="text" class="form-control-plaintext " id="postcode1" name="postcode1" value="" readonly>
                            </div>
                            <div class="form-row">
                                <label for="date1" class="col-5  col-form-label text-primary">Date</label>
                                <input type="text" class="col-7 form-control-plaintext " id="date1" name="date1" value="" readonly>
                            </div>
                            <div class="form-row">
                                <label for="startTime" class="col-5  col-form-label text-primary">Start time</label>
                                <input type="text" class="col-7 form-control-plaintext " id="startTime" name="date" value="" readonly>
                            </div>
                            <div class="form-row">
                                <label for="endTime" class="col-5  col-form-label text-primary">End Time </label>
                                <input type="text" class="col-7 form-control-plaintext " id="endTime" name="date" value="" readonly>
                            </div>
                            <div class="form-row">
                                <label for="price" class="col-5 col-form-label text-primary">Price: </label>
                                <input type="text" class="col-7 form-control-plaintext " id="price" name="price" value="" readonly>
                            </div>
    {{--
                            TODO Change btn to submit
    --}}
                            <a href="#" class="btn btn-primary">Confirm Booking</a>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
@endsection
