<!--<div style="width:26%; height: 100%; float: left">
    <div  class="card bg-light text-center shadow p-3 mb-5 border-0 card-image rounded-lg shadow col-sm-0" style="width: 18rem; background-size: cover">
        <h4>Roster</h4>
    </div>



</div>-->
<div style="width:100%;">
    @include('Security.timetable')
    <div class="container">
        <div class="row">
            <div class="col-3 h-100">
                <div class="row">
                    <h3>Annual Leave</h3>
                </div>
                <div class="row ml-2">
                    <a href="#leaveRequests"  class="disabled alBtn" onclick="alToggle()">View Leave Requests</a>
                </div>
                <div class="row ml-2">
                    <a href="#leaveApplication" class="alBtn" onclick="alToggle()">Apply for leave</a>
                </div>

            </div>
            <div class="annual-leave-page h-100 col-9 container jumbotron bg-light mr-0 pt-2 pb-2" id="leaveRequests">
                <div class="row">
                    <h3 class="text-center w-100"> Leave Requests</h3>
                </div>
                    @if(count($staff->leave_requests) > 0)
                        @foreach($staff->leave_requests as $record)
                            <div class="container my-3 shadow-sm bg-white py-2">
                                <div class="row pl-3">
                                    <h6>{{$record->subject}}</h6>
                                </div>
                                <div class="row">
                                    <div class="col">Type: {{$record->absence_types->description}}</div>
                                    <div class="col"> Status: <span class="font-italic status-{{$record->absence_status->description}}">{{$record->absence_status->description}}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col">Date: {{\Carbon\Carbon::parse($record->start_date)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($record->end_date)->format('d/m/Y')}}</div>
                                    <div class="col"> Updated on: {{\Carbon\Carbon::parse($record->updated_on)->format('d/m/Y')}}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row"><h6 class="text-center w-100">Nothing to show</h6></div>
                    @endif
            </div>
            <div class="annual-leave-page h-100 col-6 container jumbotron bg-light pt-2 pb-2 al-hidden" id="leaveApplication">
                <div class="row text-center">
                    <h3 class="text-center mr-auto ml-auto">Apply for leave</h3>
                </div>
                <form method="POST" action="{{route('staff.postLeave')}}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <label class="w-100">
                            <input class="form-control" type="text" name="subject" id="alSubject" placeholder="Subject" maxlength="50" autocomplete="false" required>
                        </label>
                    </div>
                    <div class="form-row">
                        <label class="w-100">
                            <textarea type="text" rows="7" style="resize: none" class="form-control"  name="message" id="alMessage" placeholder="Message" maxlength="300" required></textarea>
                        </label>
                    </div>
                    <div class="form-row">
                        <div class="w-100">
                            <label for="type"><strong>Absence Type:</strong></label>
                        </div>
                        <div class="w-100">
                            <select class="form-control" id="type" name="type" required>
                                @foreach(\App\Absence_Types::all() as $type)
                                    <option value="{{$type->id}}">{{$type->description}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-row mt-2">
                        <div class="col px-0">
                            <div>
                                <label for="alStartDate"><strong>Start Date: </strong></label>
                            </div>
                            <div>
                                <input class="form-control" type="date" min="{{Carbon\Carbon::parse(today("NZ")->addDay())->format('Y-m-d')}}" id="alStartDate" name="startDate" oninput="dateValidation(this)" required>
                            </div>

                        </div>
                        <div class="col px-0">
                            <div>
                                <label for="alEndDate">
                                    <strong>End Date: </strong>
                                </label>
                            </div>
                            <div>
                                <input class="form-control" type="date" min="{{Carbon\Carbon::parse(today("NZ")->addDay())->format('Y-m-d')}}" id="alEndDate" name="EndDate" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-row mt-3 pt-3 pb-2 ml-auto border-top w-100">
                        <input type="submit" value="Save" class="ml-auto btn btn-success ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

