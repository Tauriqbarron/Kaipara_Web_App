<div style="width:26%; height: 100%; float: left">
    <div  class="card bg-light shadow p-3 mb-5 border-0 card-image rounded-lg shadow col-sm-0" style="width: 18rem; background-image: url({{url('images/Card_BG.jpg')}}); background-size: cover">
        <div id="cardHeader" class="card-header bg-light border-0 rounded">
            <img class="w-100 align-top" src="{{url('images/Card_Header.png')}}" alt="Card top">
        </div>
        <img class="card-img-top rounded-circle border-light shadow border-3 w-75 mr-auto ml-auto mb-auto" src="{{url($staff->imgPath)}}" alt="Card image cap">
        <div class="mt-4 card-body text-light">
            <h5 class="card-title text-center">{{$staff->first_name}} {{$staff->last_name}}</h5>
            <h5 class="card-title text-center">{{$staff->phone_number}}</h5>
            <h5 class="card-title text-center">{{$staff->id}}</h5>

        </div>

        <div class="card-footer bg-dark rounded">
            <img class="w-100 align-top" src="{{url('images/KaiparaLogo.png')}}" alt="Card top">
        </div>
    </div>



</div>
<div style="width:74%; float: left; padding-left: 20px">
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <strong>{{$message}}</strong>
        </div>
    @endif
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
                                    <a href="#" onclick="dateChangeRight()"><i class="fa fa-chevron-left fa-2x date-arrow" id="dateLeft" ></i></a>
                                </th>
                                <th colspan="3" class="text-center text-secondary" style="vertical-align: bottom">
                                    <h3>{{Carbon\Carbon::parse(Session::get('date1'))->format('d/m/Y')}}</h3>
                                </th>
                                <th>
                                    <a href="#"> <i class="fa fa-chevron-right fa-pull-right fa-2x date-arrow"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($bookings as $booking )

                                <tr>
                                    <td class="text-center">
                                        <h6>{{number_format($booking->start_time, 2, ":","")}}</h6>
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
                                        <a href="#" class="table-link fa-pull-right" data-toggle="collapse" data-target="#n{{$booking->id}}" id="downButton" onmouseup="f('{{$booking->id}}n','n{{$booking->id}}')" >

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


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('Security.roster')
</div>

