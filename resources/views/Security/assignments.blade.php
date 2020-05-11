<div style="width:26%; height: 100%; float: left">
    <div style="height: 48px"></div>
    <div class="rounded" style="background-color: #636b6f; width: 105%; height: 400px" id="map"></div>

</div>
<div style="width:74%; float: left; padding-left: 20px">
    <h2 class="text-center">Available Assignments</h2>
    <div class="container jumbotron bg-light" id="schedule">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <tbody>

                            @foreach($availableBookings as $booking )
                                <script style="display: none">
                                    addAddress('{{$booking->street}} {{$booking->suburb}} {{$booking->city}} New Zealand');
                                </script>
                                <tr>
                                    <td class="text-center">
                                        <h6>{{$booking->start_time}}</h6>
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
                                        <a href="#" title="More Information" class="table-link fa-pull-right" data-toggle="collapse" data-target="#a{{$booking->id}}" id="downButton" onmouseup="f('{{$booking->id}}a','a{{$booking->id}}')" >

                                            <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="{{$booking->id}}a"></i>
                                                    </span>
                                        </a>

                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="4" style="padding: 0px" class="bg-white">
                                        <div class="collapse"  id="a{{$booking->id}}" style="padding: 10px">
                                            {{$booking->description}} required at {{$booking->street}}, {{$booking->suburb}}, {{$booking->city}} at {{$booking->start_time}} on {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y')}}
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
            </div>
        </div>
    </div>
</div>

