<!--<div style="width:26%; height: 100%; float: left">
    <div  class="card bg-light text-center shadow p-3 mb-5 border-0 card-image rounded-lg shadow col-sm-0" style="width: 18rem; background-size: cover">
        <h4>Roster</h4>
    </div>



</div>-->
<div style="width:100%;">
    <div class="container jumbotron bg-light" id="schedule">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table">
                        <table class="table border" style="table-layout: fixed; width: 100%">
                            <!--TODO: Add ability to filter by week-->
                            <thead>
                            <tr>
                                <th>Time</th>

                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($firstBooking = $bookings->first())


                                @php
                                        $timetable = array( );
                                        $time_start = round($bookings->min('start_time'))-1;

                                        $time_end = round($bookings->max('finish_time'))+1;
                                        $time_hours = $time_end - $time_start;
                                        for($i=0;$i<$time_hours;$i++){
                                            $leadingZero = '';
                                            if(($i+$time_start)<10) $leadingZero = '0';
                                            array_push($timetable, array(array($leadingZero.($i+$time_start).':00')));
                                        }

                                        for($i=1; $i<8; $i++){

                                            for($j=0; $j<$time_hours;$j++){
                                                $time = $j+$time_start;

                                                foreach ($bookings as $booking){
                                                    $start = round($booking->start_time);
                                                    $startLeadingZero = '';
                                                    if($start < 10) $startLeadingZero = '0';
                                                    $finish = round($booking->finish_time);
                                                    $finishLeadingZero = '';
                                                    if($finish < 10) $finishLeadingZero = '0';

                                                    $hours = $finish - $start;

                                                    if($start == $time && \Carbon\Carbon::parse($booking->date)->dayOfWeek == $i-1){
                                                        array_push($timetable[$j],
                                                            array(
                                                                $hours,
                                                                'Booking ID: '.$booking->id,
                                                                $startLeadingZero.number_format($booking->start_time, 2, ":","")." - ".$finishLeadingZero.number_format($booking->finish_time, 2, ":",""),
                                                                $booking->description
                                                            )
                                                        );
                                                        $j += $hours;
                                                        continue;
                                                    }
                                                }
                                                if($j < $time_hours){
                                                array_push($timetable[$j], array("wat"));
                                                }
                                            }
                                        }
                                @endphp


                                @foreach($timetable as $row)

                                    <tr>
                                        @foreach($row as $col)
                                            @if($col == $row[0])
                                                <th class="border" style="width: 5%">
                                                    {{$col[0]}}
                                                </th>
                                                @elseif($col[0] == 'wat')
                                                    <td class="border-light bg-white" style="width: 13%"></td>
                                                    @else
                                                        <td rowspan="{{$col[0]}}" class="text-center text-light rounded-lg border border-white" style="color: #262525; background-color: #dd504c; width: 13%" >
                                                            <strong>
                                                            @foreach($col as $record)
                                                                @if($record === $col[0])
                                                                    @continue
                                                                    @endif
                                                                {{$record}}<br>
                                                                @endforeach
                                                            </strong>
                                                        </td>
                                                @endif
                                            @endforeach
                                    </tr>
                                    @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

