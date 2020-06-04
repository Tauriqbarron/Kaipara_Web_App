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
                            <thead>
                            <tr class="w-100" style="width: 100%">
                                <th >
                                    <a href="{{route('security.setWeek', ['i' => -1])}}"><i class="fa fa-chevron-left fa-2x date-arrow" id="dateLeft" ></i></a>
                                </th>
                                <th colspan="6" class="text-center text-secondary" style="vertical-align: bottom">
                                    <h3 id="myAssignmentDate">{{Carbon\Carbon::parse(Session::get('weekStart'))->format('d/m/Y')}} - {{Carbon\Carbon::parse(Session::get('weekEnd'))->format('d/m/Y')}}</h3>
                                </th>
                                <th>
                                    <a href="{{route('security.setWeek', ['i' => 1])}}"> <i class="fa fa-chevron-right float-right fa-2x date-arrow float-right"></i></a>
                                </th>
                            </tr>
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

                            @if($firstBooking = $timetable->first())


                                @php
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);
                                        $timetableArray = array( );
                                        $time_start = round($timetable->min('start_time'))-1;

                                        $time_end = round($timetable->max('finish_time'))+1;
                                        $time_hours = $time_end - $time_start;
                                        for($i=0;$i<$time_hours;$i++){
                                            $leadingZero = '';
                                            if(($i+$time_start)<10) $leadingZero = '0';
                                            array_push($timetableArray, array(array($leadingZero.($i+$time_start).':00')));
                                        }

                                        for($i=1; $i<8; $i++){

                                            for($j=0; $j<$time_hours;$j++){
                                                $time = $j+$time_start;

                                                foreach ($timetable as $t){
                                                    $start = round($t->start_time);
                                                    $startLeadingZero = '';
                                                    if($start < 10) $startLeadingZero = '0';
                                                    $finish = round($t->finish_time);
                                                    $finishLeadingZero = '';
                                                    if($finish < 10) $finishLeadingZero = '0';

                                                    $hours = $finish - $start;

                                                    if($start == $time && \Carbon\Carbon::parse($t->date)->dayOfWeek == $i-1){
                                                        array_push($timetableArray[$j],
                                                            array(
                                                                $hours,
                                                                'Booking ID: '.$t->id,
                                                                $startLeadingZero.number_format($t->start_time, 2, ":","")." - ".$finishLeadingZero.number_format($t->finish_time, 2, ":",""),
                                                                $t->description,
                                                                $t->date
                                                            )
                                                        );
                                                        $j += $hours;
                                                        continue;
                                                    }
                                                }
                                                if($j < $time_hours){
                                                array_push($timetableArray[$j], array("wat"));
                                                }
                                            }
                                        }
                                @endphp


                                @foreach($timetableArray as $row)

                                    <tr>
                                        @foreach($row as $col)
                                            @if($col == $row[0])
                                                <th class="border" style="width: 5%">
                                                    {{$col[0]}}
                                                </th>
                                                @elseif($col[0] == 'wat')
                                                    <td class="border-light bg-white" style="width: 13%"></td>
                                                    @else
                                                    <td rowspan="{{$col[0]}}" class="text-center text-light rounded-lg border border-white" style="color: #262525; background-color: #dd504c; width: 13%; cursor: pointer" onclick="window.location.href = '{{route('security.dateChange',['i'=>(\Carbon\Carbon::parse($col[4])->dayOfYear - \Carbon\Carbon::Parse(\Illuminate\Support\Facades\Session::get('date1'))->dayOfYear)])}}'">
                                                        <strong>
                                                            @foreach($col as $record)
                                                                @if($record === $col[0] || $record === $col[4])
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

                                @else
                                <tr><th colspan="8" class="text-center">Nothing to show</th></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

