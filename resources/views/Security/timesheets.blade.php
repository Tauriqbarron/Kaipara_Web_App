

    <h2 class="text-center">Your Timesheets</h2>
    <div class="container jumbotron bg-light" id="schedule">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <tbody>

                                @foreach($timesheets as $timesheet)
                                    <tr>
                                        <td>
                                            <h6>{{\Carbon\Carbon::parse($timesheet->date)->isoFormat('dddd Do MMM')}}</h6>
                                        </td>
                                        <td class="text-center {{isset($timesheet->stop_time) ? '' : 'text-danger'}}">
                                            <h6>{{\Carbon\Carbon::parse(number_format($timesheet->start_time, 2, ":",""))->isoFormat('LT')}} - {{isset($timesheet->stop_time) ? \Carbon\Carbon::parse(number_format($timesheet->stop_time, 2, ":",""))->isoFormat('LT') : 'In Progress'}}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="label label-default">{{$timesheet->staff_assignment->booking->booking_type->description}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$timesheet->staff_assignment->booking->city}}</h6>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="#" class="table-link float-right" data-toggle="collapse" data-target="#p{{$timesheet->id}}" id="downButton" onmouseup="f('{{$timesheet->id}}p','p{{$timesheet->id}}')" >
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="{{$timesheet->id}}p"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td colspan="5" class="bg-white p-0">
                                            <span class="collapse" id="p{{$timesheet->id}}"></span>
                                            <div class="collapse container px-5"  id="p{{$timesheet->id}}">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="mb-0 mt-2">{{$timesheet->staff_assignment->booking->booking_type->description}} on {{ \Carbon\Carbon::parse($timesheet->date)->isoFormat('dddd Do MMM')}}</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        {{$timesheet->staff_assignment->booking->description}}
                                                    </div>
                                                </div>
                                                <div class="row pl-2">
                                                    <div class="col-2">
                                                        <strong>Time</strong>
                                                    </div>
                                                    <div class="col-10">
                                                        {{\Carbon\Carbon::parse(number_format($timesheet->start_time, 2, ":",""))->isoFormat('LT')}} - {{isset($timesheet->stop_time) ? \Carbon\Carbon::parse(number_format($timesheet->stop_time, 2, ":",""))->isoFormat('LT') : 'In Progress'}}
                                                    </div>
                                                </div>
                                                <div class="row pl-2">
                                                    <div class="col-2">
                                                        <strong>Date</strong>
                                                    </div>
                                                    <div class="col-10">
                                                        {{\Carbon\Carbon::parse($timesheet->date)->format('d/m/Y')}}
                                                    </div>
                                                </div>
                                                <div class="row pl-2">
                                                    <div class="col-2">
                                                        <strong>Address</strong>
                                                    </div>
                                                    <div class="col-10">
                                                        {{$timesheet->staff_assignment->booking->street}}<br>{{$timesheet->staff_assignment->booking->suburb}}<br>{{$timesheet->staff_assignment->booking->city}}, {{$timesheet->staff_assignment->booking->postcode}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        @if(!isset($timesheet->stop_time))
                                                            <form method="POST" action="{{route('staff.stopJob')}}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger w-100" name="timesheet_id" value="{{$timesheet->id}}">Stop</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>

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

