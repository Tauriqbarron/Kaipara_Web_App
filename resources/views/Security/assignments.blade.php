<div class="profile-card-col">
    <div style="height: 48px"></div>
    <div class="assignment-map rounded" id="map"></div>
    @include('Security.sideNav')


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
                            <a href="#" onclick="setCenter('{{$booking->street}} {{$booking->suburb}} {{$booking->city}} New Zealand')"><i class="fa fa-map-marker fa-2x fa-light"></i></a>
                        </td>
                        <td class="text-center">
                            <h6>{{\Carbon\Carbon::parse(number_format($booking->start_time, 2, ":",""))->isoFormat('LT')}}</h6>
                        </td>
                        <td>
                            <h6>{{ \Carbon\Carbon::parse($booking->date)->isoFormat('ddd Do MMM')}}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="label label-default">{{$booking->booking_type->description}}</h6>
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
                        <td colspan="5" style="padding: 0px" class="bg-white">
                            <span class="collapse" id="a{{$booking->id}}"></span>
                            <div class="collapse container px-5"  id="a{{$booking->id}}">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0 mt-2">{{$booking->booking_type->description}} on {{ \Carbon\Carbon::parse($booking->date)->isoFormat('ddd Do MMM')}}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {{$booking->description}}
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col-2">
                                        <strong>Time</strong>
                                    </div>
                                    <div class="col-10">
                                        {{Carbon\Carbon::parse(substr('00:00', 0, (-(strlen(number_format($booking->start_time ,2 , ':','')))) ) . number_format($booking->start_time ,2 , ':',''))->isoFormat('LT')}} - {{\Carbon\Carbon::parse(substr('00:00', 0, (-(strlen(number_format($booking->finish_time ,2 , ':','')))) ) . number_format($booking->finish_time ,2 , ':',''))->isoFormat('LT')}}
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col-2">
                                        <strong>Date</strong>
                                    </div>
                                    <div class="col-10">
                                        {{\Carbon\Carbon::parse($booking->date)->isoFormat('ddd Do MMM')}} - {{\Carbon\Carbon::parse($booking->end_date)->isoFormat('ddd Do MMM')}}
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col-2">
                                        <strong>Address</strong>
                                    </div>
                                    <div class="col-10">
                                        {{$booking->street}}<br>{{$booking->suburb}}<br>{{$booking->city}}, {{$booking->postcode}}
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col-2">
                                        <strong>Client Name</strong>
                                    </div>
                                    <div class="col-10">
                                        {{$booking->client->first_name}} {{$booking->client->last_name}}
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col-2">
                                        <strong>Phone</strong>
                                    </div>
                                    <div class="col-10">
                                        {{$booking->client->phone_number}}
                                    </div>
                                </div>

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
                            <h6>{{ \Carbon\Carbon::parse($booking->date)->isoFormat('ddd Do MMM')}}</h6>
                        </td>
                        <td class="text-center">
                            <h6 class="label label-default">{{\Carbon\Carbon::parse(number_format($booking->start_time, 2, ":",""))->isoFormat('LT')}}</h6>
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
                    @if(count($booking->staff_assignments) > 0)
                        @foreach($booking->staff_assignments as $sa)

                            @if($sa->staff_id == auth()->guard('staff')->user()->id)

                                <tr class="bg-light" >
                                    <td colspan="4" style="padding: 0px" class="bg-light">
                                        <span class="collapse" id="sa{{$booking->id}}"></span>
                                        <div style="padding: 10px"  class="collapse" id="sa{{$booking->id}}">
                                            {{$booking->description}} required at {{$booking->street}}, {{$booking->suburb}}, {{$booking->city}} at {{\Carbon\Carbon::parse(number_format($booking->start_time, 2, ":",""))->isoFormat('LT')}} on {{ \Carbon\Carbon::parse($booking->date)->isoFormat('ddd Do MMM')}}
                                        </div>
                                    </td>
                                    <td style="padding: 0px" class="bg-light">
                                        <div style="padding: 10px"  class="collapse" id="sa{{$booking->id}}">
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
                                                    {{\Carbon\Carbon::parse($timesheet->date)->isoFormat('ddd Do MMM')}}
                                                </div>
                                            </td>
                                            <td style="padding: 0" class="border-0 bg-white" >
                                                <div class="collapse" id="sa{{$booking->id}}" style="padding:10px">
                                                    {{\Carbon\Carbon::parse(number_format($timesheet->start_time, 2, ":", ""))->isoFormat('LT')}}
                                                </div>
                                            </td>
                                            <td style="padding: 0"  class="border-0 bg-white" >
                                                <div class="collapse" id="sa{{$booking->id}}" style="padding:10px">
                                                    {{\Carbon\Carbon::parse(number_format($timesheet->stop_time, 2, ":", ""))->isoFormat('LT')}}
                                                </div>
                                            </td>
                                            <td style="padding: 0" colspan="2"  class="border-0 bg-white">
                                                <div class="collapse" id="sa{{$booking->id}}"  style="padding:10px; text-align: right">
                                                    {{number_format((floor($timesheet->stop_time) + (($timesheet->stop_time - floor($timesheet->stop_time))/.6)) - (floor($timesheet->start_time) + (($timesheet->start_time - floor($timesheet->start_time))/.6)),2)}}
                                                    @php($totalHours += (floor($timesheet->stop_time) + (($timesheet->stop_time - floor($timesheet->stop_time))/.6)) - (floor($timesheet->start_time) + (($timesheet->start_time - floor($timesheet->start_time))/.6)))
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
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

