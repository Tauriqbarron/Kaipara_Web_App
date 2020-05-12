<div style="width:26%; height: 100%; float: left">
    <div  class="card bg-light shadow p-3 mb-5 border-0 card-image rounded-lg shadow col-sm-0" style="width: 18rem; background-size: cover">
        <h4>Roster</h4>
    </div>



</div>
<div style="width:74%; float: left; padding-left: 20px">
    <div class="container jumbotron bg-light" id="schedule">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th>Time</th>

                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Sunday</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $noJob = 1;
                                $hours = 0;
                                $day = -1;
                            @endphp

                            @for($i = 0; $i < 19; $i++)
                                <tr>
                                    <th>
                                        @if(($i+5) < 10 )
                                        0{{$i+5}}:00
                                            @else
                                            {{$i+5}}:00
                                        @endif
                                    </th>
                                    @for($j=0;$j<7;$j++)
                                        @foreach($bookings as $booking)
                                            @php
                                                $noJob = 1;
                                                $time = '';
                                                if(($i+5) < 10){
                                                    $time = '0'.(5+$i).':00';

                                                }else{
                                                    $time = (5+$i).':00';
                                                }

                                            @endphp
                                            @if($booking->start_time == $time && ((\Carbon\Carbon::parse($booking->date)->dayOfWeek) == $j) )
                                                <td class="text-center"rowspan="5" style="color: #262525; background-color: #dd504c"> {{$booking->start_time}} - {{10+$i}}:00<br>{{$booking->description}} </td>
                                                @php
                                                    $noJob = 0;
                                                    $day = $j;
                                                    $hours = 4;
                                                @endphp
                                                @else

                                            @endif


                                        @endforeach
                                        @if($noJob && ($day != $j))
                                            <td></td>
                                            @elseif($hours == 0)
                                                @php($day = -1)
                                            @else
                                                @php($hours--)
                                        @endif

                                    @endfor

                                </tr>

                            @endfor



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

