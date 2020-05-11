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
                                    @for($i = 0; $i < 12; $i++)

                                        <tr>
                                        <th>
                                            {{$i+5}}:00
                                        </th>
                                        @for($j=0;$j<7;$j++)
                                            @foreach($bookings as $booking)
                                                @if($booking->start_time == (5+$i.':00') )
                                                    <td rowspan="5" style="color: #262525; background-color: #dd504c"></td>
                                                @else
                                                    <td></td>
                                                @endif

                                            @endforeach
                                            <td></td>
                                        @endfor

                                    @endfor



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

