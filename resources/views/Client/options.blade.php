<button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#custom" aria-expanded="false" aria-controls="custom">
    Create Custom Schedule
</button>

<div class=" collapse-observe collapse w-100" id="custom">

    <div class="w-100 card card-body">
        <div id="accordion">
            {{---------------------------------------}}
            {{---------------------------------------}}
            {{--------------Card 1-------------------}}
            {{---------------------------------------}}
            {{---------------------------------------}}

            <div class="row">
                <div class="card w-100">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Select Days
                            </button>
                        </h5>
                    </div>
                    {{-- TODO uncheck checboxes when closed, add start and end time to day picker--}}
                    <div id="collapseOne" class=" collapse-observe collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    @php($days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'))
                                    @for( $i = 0; $i < 7; $i++)
                                        @php($record = $days[$i])
                                        <div class="form-check">
                                            <input class="form-check-input day-check" type="checkbox" data-info="{{$record}}" id="defaultCheck{{$record}}">
                                            <label class="form-check-label" for="defaultCheck{{$record}}">
                                                {{$record}}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="ongoingCheck" >
                                        <label class="form-check-label" for="ongoingCheck">
                                            Ongoing
                                        </label>
                                    </div>
                                    <div class="mt-3 bg-light rounded p-4" style="margin-left:-80px;">
                                        <div class="form-row">
                                            <div class="col">
                                                <label class="my-auto" for="appt">Select Start time:</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control start-time-input" data-sibling="dayEndInput"  type="time" id="dayStartInput" onchange="overviewStart(this.value)">
                                            </div>
                                        </div>
                                        <div class="form-row mt-1">
                                            <div class="col">
                                                <label class="my-auto" for="appt">Select End time:</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control end-time-input" data-sibling="dayStartInput" type="time" id="dayEndInput" onchange="overviewEnd(this.value)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{---------------------------------------}}
            {{---------------------------------------}}
            {{--------------Card 2-------------------}}
            {{---------------------------------------}}
            {{---------------------------------------}}
            <div class="row">
                <div class="card w-100">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#collapseToo" aria-expanded="false" aria-controls="collapseToo">
                                Or Select A Date and Time
                            </button>
                        </h5>
                    </div>
                    <div id="collapseToo" class=" collapse-observe collapse" aria-labelledby="headingTwo" data-parent="#accordion">
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
            </div>
            {{---------------------------------------}}
            {{---------------------------------------}}
            {{--------------Card 3-------------------}}
            {{---------------------------------------}}
            {{---------------------------------------}}
            <div class="row">
                <div class="card w-100">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-primary w-100" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Or Select a due date
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class=" collapse-observe collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    <label for="dueDateInput">Select Date</label>
                                    <input type="date" class="form-control" id="dueDateInput" min="{{\Carbon\Carbon::parse(today('NZ')->addDay())->format('Y-m-d')}}"  onchange="overviewDate(this.value)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
