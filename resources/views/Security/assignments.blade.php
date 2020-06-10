<div class="profile-card-col">
    <div style="height: 48px"></div>
    <div class="assignment-map rounded" id="map"></div>
    <div  class="jumbotron bg-light shadow-sm rounded" style="margin-top:10px;width: 301px;padding: 10px;position: fixed">
        <div style="">
            <h6>Jump to:</h6>
            <a href="#available" class="nav-link"><h6>Available Assignments</h6></a>
            <a href="#completed" class="nav-link"><h6>Completed Assignments</h6></a>
            <a href="#leaveRequests" onclick="pageToggle('rosterBtn','rosterContainer')"  class="nav-link"><h6>Annual Leave</h6></a>
        </div>
    </div>


</div>
<div style="width:74%; float: left; padding-left: 20px">
    <h2 class="text-center" id="available">Available Assignments</h2>
    <div class="container jumbotron bg-light main-box clearfix" id="schedule">
        <div class="table-responsive">
            <table class="table user-list">
                <tbody>
                @foreach($availableBookings as $booking )
                    <script style="display: none">
                        addAddress('{{$booking->street}} {{$booking->suburb}} {{$booking->city}} New Zealand');
                    </script>
                    <tr>
                        <td class="text-center">
                            <a href="#" onclick="setCenter('{{$booking->street}} {{$booking->suburb}} {{$booking->city}} New Zealand')"><i class="fa fa-map-marker fa-2x fa-light float-left"></i></a><h6>{{number_format($booking->start_time, 2, ":","")}}</h6>
                        </td>
                        <td>
                            <h6>{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y')}}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="label label-default">{{$booking->description}}</h6>
                        </td>
                        <td>
                            <h6>{{$booking->city}}</h6>
                        </td>
                        <td style="width: 20%;">
                            <a href="#" title="More Information" class="table-link float-right" data-toggle="collapse" data-target="#a{{$booking->id}}" id="downButton" onmouseup="f('{{$booking->id}}a','a{{$booking->id}}')" >
                                <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="{{$booking->id}}a"></i>
                                </span>
                            </a>
                        </td>
                    </tr>

                        <tr >
                            <td colspan="4" style="padding: 0px" class="bg-white">
                                <span class="collapse" id="a{{$booking->id}}"></span>
                                <div class="collapse"  id="a{{$booking->id}}" style="padding: 10px">
                                    {{$booking->description}} required at {{$booking->street}}, {{$booking->suburb}}, {{$booking->city}} at {{number_format($booking->start_time, 2, ":","")}} on {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y')}}
                                </div>
                            </td>
                            <td style="padding: 0px" class="bg-white">
                                <div class="collapse btn-group-lg"  id="a{{$booking->id}}" style="padding: 10px">
                                    <a type="button" class="btn-primary text-white w-100 rounded border-0 text-center text-decoration-none" href="{{route('security.acceptBooking', ['booking_id' => $booking->id])}}"><h6>Accept</h6></a>
                                </div>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <h2 class="text-center" id="completed">Completed Assignments</h2>
    <div class="container jumbotron bg-light main-box clearfix" style="padding: 10px; margin-bottom: 0px;">
        <div class="table-responsive">
            <table class="table user-list">
                <tbody>
                @foreach($completedBookings as $booking )


                    <tr>
                        <td class="text-center">
                        </td>
                        <td>
                            <h6>{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y')}}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="label label-default">{{number_format($booking->start_time, 2, ":","")}}</h6>
                        </td>
                        <td>
                            <h6>{{$booking->city}}</h6>
                        </td>
                        <td style="width: 20%;">
                            <a href="#" title="More Information" class="table-link float-right" data-toggle="collapse" data-target="#sa{{$booking->id}}" id="downButton" onmouseup="f('{{$booking->id}}sa','sa{{$booking->id}}')" >
                                <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="{{$booking->id}}sa"></i>
                                </span>
                            </a>
                        </td>
                    </tr>

                    <!--TODO create a css class for cell backgrounds and padding, get rid of inline style defs-->
                    @if(count($booking->staff_assignments) > 0)
                        @foreach($booking->staff_assignments as $sa)

                            @if($sa->staff_id == auth()->guard('staff')->user()->id)

                                <tr class="bg-light" >
                                    <td colspan="4" style="padding: 0px" class="bg-light">
                                        <span class="collapse" id="sa{{$booking->id}}"></span>
                                        <div style="padding: 10px"  class="collapse" id="sa{{$booking->id}}">
                                            {{$booking->description}} required at {{$booking->street}}, {{$booking->suburb}}, {{$booking->city}} at {{number_format($booking->start_time, 2, ":","")}} on {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y')}}
                                        </div>
                                    </td>
                                    <td style="padding: 0px" class="bg-light">
                                        <div style="padding: 10px"  class="collapse" id="sa{{$booking->id}}">
                                            <!--TODO feedback only for completed jobs, check if feedback has been sent already by the staff member and grey out button if it has
                                                    - figure out a way to distinguish between staff and client feedback -->
                                            @if(!(count($sa->feedback) > 0))
                                                <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#f{{$booking->id}}">
                                                    Feedback
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-secondary disabled w-100" style="cursor: not-allowed">
                                                    Feedback Sent
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @if(count($sa->timesheet) > 0)
                                    <tr class="bg-light">
                                        <td style="padding: 0" class="border-0 bg-light" >
                                            <div class="collapse" id="sa{{$booking->id}}" style="padding:10px;">
                                            </div>
                                        </td>
                                        <td style="padding: 0" class="border-0 bg-light" >
                                            <div class="collapse" id="sa{{$booking->id}}" style="padding:10px;">
                                                <strong>
                                                    Date
                                                </strong>
                                            </div>
                                        </td>
                                        <td style="padding: 0"  class="border-0 bg-light" >
                                            <div class="collapse" id="sa{{$booking->id}}" style="padding:10px;">
                                                <strong>
                                                    Start Time
                                                </strong>

                                            </div>
                                        </td>
                                        <td style="padding: 0" class="border-0 bg-light"  >
                                            <div class="collapse" id="sa{{$booking->id}}" style="padding:10px;">
                                                <strong>
                                                    Stop Time
                                                </strong>

                                            </div>
                                        </td>
                                        <td style="padding: 0" colspan="2"  class="border-0 bg-light">
                                            <div class="collapse" id="sa{{$booking->id}}" style="padding:10px; text-align: right">
                                                <strong>
                                                    Hours
                                                </strong>

                                            </div>
                                        </td>

                                    </tr>
                                    @php($totalHours = 0)
                                    @foreach($sa->timesheet as $timesheet)
                                        <!--Display timesheets here-->
                                        <tr class="bg-white">
                                            <td style="padding: 0"  class="border-0 bg-white" >
                                                <div class="collapse" id="sa{{$booking->id}}" style="padding:10px">
                                                </div>
                                            </td>
                                            <td style="padding: 0"  class="border-0 bg-white" >
                                                <div class="collapse" id="sa{{$booking->id}}" style="padding:10px">
                                                    {{\Carbon\Carbon::parse($timesheet->date)->format('d/m/Y')}}
                                                </div>
                                            </td>
                                            <td style="padding: 0" class="border-0 bg-white" >
                                                <div class="collapse" id="sa{{$booking->id}}" style="padding:10px">
                                                    {{number_format($timesheet->start_time, 2, ":", "")}}
                                                </div>
                                            </td>
                                            <td style="padding: 0"  class="border-0 bg-white" >
                                                <div class="collapse" id="sa{{$booking->id}}" style="padding:10px">
                                                    {{number_format($timesheet->stop_time, 2, ":", "")}}
                                                </div>
                                            </td>
                                            <td style="padding: 0" colspan="2"  class="border-0 bg-white">
                                                <div class="collapse" id="sa{{$booking->id}}"  style="padding:10px; text-align: right">
                                                    {{$timesheet->stop_time - $timesheet->start_time}}
                                                    @php($totalHours += ($timesheet->stop_time - $timesheet->start_time))
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="bg-white" style="padding: 0">
                                            <div class="collapse" id="sa{{$booking->id}}" style="padding:10px; text-align: right">
                                                <strong>Total Hours: {{$totalHours}}</strong>
                                            </div>
                                        </td>
                                    </tr>

                                @endif
                                @break
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

