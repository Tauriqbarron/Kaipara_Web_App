
<div style="width:26%; height: 100%; float: left">
    <div style="height: 48px"></div>
    <div class="rounded" style="background-color: #636b6f; width: 105%; height: 400px" id="scheduleMap"></div>

</div>

<div style="width:74%; float: left; padding-left: 20px">
    <h2 class="text-center">Your Assignments</h2>
    <div class="container jumbotron bg-light" id="schedule">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th >
                                    <a href="{{route('security.dateChange', ['i' => -1])}}"><i class="fa fa-chevron-left fa-2x date-arrow" id="dateLeft" ></i></a>
                                </th>
                                <th colspan="3" class="text-center text-secondary" style="vertical-align: bottom">
                                    <h3 id="myAssignmentDate">{{Carbon\Carbon::parse(Session::get('date1'))->format('d/m/Y')}} </h3>
                                </th>
                                <th>
                                    <a href="{{route('security.dateChange', ['i' => 1])}}"> <i class="fa fa-chevron-right float-right fa-2x date-arrow"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($firstBookings = $bookings->first())

                                @foreach($bookings as $booking )

                                    <tr>
                                        <td class="text-center">
                                            <a style="color: #636b6f;" href="#" onclick="setScheduleCenter('{{$booking->street}}, {{$booking->suburb}}, {{$booking->city}}, New Zealand')"><i class="fa fa-map-marker fa-2x fa-light float-left"></i></a><h6>{{number_format($booking->start_time, 2, ":","")}}</h6>
                                        </td>

                                        <td>
                                            <h6>{{$booking->street}}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="label label-default">{{$booking->suburb}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$booking->city}}</h6>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="#" class="table-link float-right" data-toggle="collapse" data-target="#n{{$booking->id}}" id="downButton" onmouseup="f('{{$booking->id}}n','n{{$booking->id}}')" >

                                            <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="{{$booking->id}}n"></i>
                                                    </span>
                                            </a>
                                            </a>

                                        </td>
                                    </tr>
                                    <tr >
                                        <td colspan="4" style="padding: 0px" class="bg-white">
                                            <div class="collapse"  id="n{{$booking->id}}" style="padding: 10px">
                                                {{$booking->description}} on {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y')}}
                                            </div>
                                        </td>
                                        <td style="padding: 0px" class="bg-white">
                                            <div class="collapse btn-group-lg"  id="n{{$booking->id}}" style="padding: 10px">
                                                <!--<button class="btn-primary text-white w-100 rounded border-0" type="submit"><h6>Accept</h6></button>-->
                                                <!--<button class="btn-danger text-white w-100 rounded border-0"><h6>Decline</h6></button>-->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><th colspan="5" class="text-center">Nothing to show</th></tr>
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

