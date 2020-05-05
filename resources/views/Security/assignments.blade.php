<div style="width:26%; height: 100%; float: left">
    <div  class="card bg-light shadow p-3 mb-5 border-0 card-image rounded-lg shadow col-sm-0" style="width: 18rem; background-image: url({{url('images/Card_BG.jpg')}}); background-size: cover">
        <h6>Assignment</h6>
    </div>



</div>
<div style="width:74%; float: left; padding-left: 20px">
    <div class="container jumbotron bg-light" id="schedule">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Available Assignments</h2>
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <tbody>

                            @foreach($bookings as $booking )
                                <tr>
                                    <td class="text-center">
                                        <h6>9:00</h6>
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
                                            More info
                                            <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="{{$booking->id}}n"></i>
                                                    </span>
                                        </a>

                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="4" style="padding: 0px" class="bg-white">
                                        <div class="collapse"  id="n{{$booking->id}}" style="padding: 10px">
                                            {{$booking->description}}
                                        </div>
                                    </td>
                                    <td style="padding: 0px" class="bg-white">
                                        <div class="collapse btn-group-lg"  id="n{{$booking->id}}" style="padding: 10px">
                                            <button class="btn-primary text-white w-100 rounded border-0" type="submit"><h6>Accept</h6></button>
                                            <button class="btn-danger text-white w-100 rounded border-0"><h6>Decline</h6></button>
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

