@extends('Client.layout')
@section('nav')
    <a class="nav-link active btn-lg mx-5 pt-2 bg-secondary text-white" href="#">Security</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="{{route('client.property')}}">Property Management</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Service Jobs</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Security Bookings</a>
    <a class="nav-link active btn-lg mx-5 pt-2" href="#">Quotes</a>
@endsection
@section('mainContent')

        <form class="mx-auto my-5 needs-validation" novalidate method="POST" action="{{route('client.postCreateBooking')}}">
            @csrf
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
                            <label for="number">Number of Officers Required: </label><span> </span><span type="text" id="textInput">1</span>
                            <input type="range" class="custom-range"  min="1" max="5" id="number" value="1" onchange="updateTextInput(this.value);overviewTextInput(this.value);">

                        </div>
                    </div>
                    <div class="form-row my-1 mt-4">
                        <label for="message"><h4>Description</h4></label>
                    </div>
                    <div class="form-row my-1 mb-2">
                        <textarea name="message" placeholder="The cat was playing in the garden." rows="6" class="form-control w-100" onchange="document.getElementById('description').innerHTML = this.value"></textarea>
                    </div>
                    <div class="form-group my-3">
                        <div class="form-check">
    {{--
                            TODO create function to display address of user in summary tab is checked
    --}}

                            <input class="form-check-input" type="checkbox" id="gridCheck" data-street="{{auth()->guard('client')->user()->street}}" data-suburb="{{auth()->guard('client')->user()->suburb}}" data-city="{{auth()->guard('client')->user()->city}}" data-postcode="{{auth()->guard('client')->user()->postcode}}">
                            <label class="form-check-label" for="gridCheck">
                                Use Current Address
                            </label>
                        </div>
                        <div class="form-group row my-4">
                            <label for="streetInput" class="col-sm-2 col-form-label">Street</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control address-input" id="streetInput" onchange="overviewStreet(this.value);">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="suburbInput" class="col-sm-2 col-form-label">Suburb</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control address-input w-75" id="suburbInput"  onchange="overviewSuburb(this.value);">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cityInput" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control address-input w-50" id="cityInput" onchange="overviewCity(this.value);">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="postcodeInput" class="col-sm-2 col-form-label">Postcode</label>
                            <div class="col-sm-10">
                                <input type="text" pattern="\d4" minlength="4" maxlength="4" class="form-control address-input w-25" id="postcodeInput" onchange="overviewPostcode(this.value);">
                            </div>
                        </div>
                        <div class="row">
                            <div class="btn-group btn-group-toggle w-100"  data-toggle="buttons">
                                <button class="btn btn-primary active" aria-pressed="true" id="btnSetDate" style="border-bottom-left-radius: 0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="document.getElementById('custom').classList.remove('show');">
                                    Set date and time
                                </button>
                                <button class="btn btn-primary" type="button" data-toggle="collapse" id="btnCreateCustom" data-target="#custom" style="border-bottom-right-radius: 0" aria-expanded="false" aria-controls="custom" onclick="if(document.getElementById('collapseExample').classList.contains('show')) document.getElementById('btnSetDate').click();">
                                    Create Custom Schedule
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="w-100 collapse show" id="collapseExample">
                                <div class="w-100 card card-body rounded-0">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="birthday">Select Date</label>
                                            <input class="form-control" type="date" id="birthday" min="{{\Carbon\Carbon::parse(today()->addDay())->format('Y-m-d')}}" name="birthday" onchange="overviewDate(this.value)">
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="appt">Select Start time:</label>
                                                </div>
                                                <div class="col">
                                                    <input class="form-control start-time-input" data-sibling="selEndInput"  type="time" id="selStartInput" onchange="overviewStart(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-row my-2">
                                                <div class="col">
                                                    <label for="appt">Select End time:</label>
                                                </div>
                                                <div class="col">
                                                    <input class="form-control end-time-input" data-sibling="selStartInput" type="time" id="selEndInput" onchange="overviewEnd(this.value)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="collapse w-100" id="custom">
                                <div class="card card-body w-100 rounded-0">
                                    <div id="accordion">
                                        <div class="card w-100">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                                        <div class="card w-100">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button id="btnSelectStart" class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Or Select Start and End date
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-row my-2">
                                                        <div class="col px-2">
                                                            <div class="form-row">
                                                                <label for="startDateInput">Select Start Date</label>
                                                            </div>
                                                            <div class="form-row">
                                                                <input class="form-control" type="date" id="startDateInput" min="{{\Carbon\Carbon::parse(today()->addDay())->format('Y-m-d')}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col px-2">
                                                            <div class="form-row">
                                                                <label for="endDateInput">Select End Date</label>
                                                            </div>
                                                            <div class="form-row">
                                                                <input class="form-control" type="date" id="endDateInput" min="{{\Carbon\Carbon::parse(today()->addDay())->format('Y-m-d')}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card w-100">
                                        <div class="card-header" id="headingThree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Finally Set Time
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                                            <div class="card-body form-row">
                                                <div class="col px-2">
                                                    <div class="form-row">
                                                        <label for="appt">Select Start time:</label>
                                                    </div>
                                                    <div class="form-row">
                                                        <input class="form-control start-time-input" type="time" id="createStartInput" data-sibling="createEndInput" onchange="overviewStart(this.value)">
                                                    </div>
                                                </div>
                                                <div class="col px-2">
                                                    <div class="form-row">
                                                        <label for="appt">Select End time:</label>
                                                    </div>
                                                    <div class="form-row">
                                                        <input class="form-control end-time-input" data-sibling="createStartInput" type="time" id="createEndInput" onchange="overviewEnd(this.value)">
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
                <div class="col" style="width: 50%">
                    <div class="card  bg-light float-right w-75">
                        <div class="card-header">
                            Booking Details
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <label for="type"  class="col-5 col-form-label text-primary">Assignment Type</label>
                                <input type="text" class="col-7 form-control-plaintext w-50" id="type" name="type" value="Bouncer" readonly required>
                            </div>
                            <div class="form-row">
                                <label for="number1" class="col-5  col-form-label text-primary">Number of Guards</label>
                                <input type="text" class="col-7 form-control-plaintext " id="number1" name="number1" value="1" readonly required>
                            </div>
                            <div class="form-row">
                                <label for="type" class="col-5 col-form-label text-primary">Description</label>
                                <textarea type="text" class="col-7 form-control-plaintext" id="description" name="description" readonly required></textarea>
                            </div>
                            <div class="form-row ">
                                <label for="street" class="col col-form-label text-primary">Address</label>

                                <div class="col-7">
                                    <div class="form-row">
                                        <input type="text" class="form-control-plaintext " id="street" name="street" value="" readonly required>
                                    </div>
                                    <div class="form-row">
                                        <input type="text" class="form-control-plaintext " id="suburb" name="suburb" value="" readonly required>
                                    </div>
                                    <div class="form-row">
                                        <input type="text" class="form-control-plaintext " id="city1" name="city1" value="" readonly required>
                                    </div>
                                    <div class="form-row">
                                        <input type="text" class="form-control-plaintext " id="postcode1" name="postcode1" value="" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" id="rowDateOverview">
                                <label for="date1" class="col-5  col-form-label text-primary">Date</label>
                                <div id="ovDateCol" class="col-7">
                                    <div class="form-row">
                                        <input type="text" class="col-7 form-control-plaintext " id="date1" name="date1" value="" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="startTime" class="col-5  col-form-label text-primary">Start time</label>
                                <input type="text" class="col-7 form-control-plaintext " id="txtStartTime" name="date" value="" readonly required>
                            </div>
                            <div class="form-row">
                                <label for="endTime" class="col-5  col-form-label text-primary">End Time </label>
                                <input type="text" class="col-7 form-control-plaintext " id="txtEndTime" name="date" value="" readonly required>
                            </div>
                            <div class="form-row">
                                <label for="price" class="col-5 col-form-label text-primary">Price: </label>
                                <input type="text" class="col-7 form-control-plaintext " id="price" name="price" value="" readonly required>
                            </div>
    {{--
                            TODO Change btn to submit
    --}}
                            <input type="submit" class="btn btn-primary" value="Confirm Booking"/>
                        </div>
                    </div>
                </div>

            </div>

        </form>
@endsection
