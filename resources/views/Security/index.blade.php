@extends('Security.layout')
@section('pageTitle','My Profile ')
@section('mainContent')
        <div style="width:26%; height: 100%; float: left">
             <div  class="card bg-light shadow p-3 mb-5 border-0 card-image rounded-lg shadow col-sm-0" style="width: 18rem; background-image: url('images/Card_BG.jpg'); background-size: cover">
                <div id="cardHeader" class="card-header bg-light border-0 rounded">
                    <img class="w-100 align-top" src="{{url('images/Card_Header.png')}}" alt="Card top">
                </div>
                <img class="card-img-top rounded-circle border-light shadow border-3 w-75 mr-auto ml-auto mb-auto" src="images/Profile_Placeholder_Large.jpg" alt="Card image cap">
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
            <div class="container jumbotron bg-light" id="schedule">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <div class="table-responsive">
                                <table class="table user-list">
                                    <thead>
                                        <tr>
                                            <th >
                                                <a href="#"><i class="fa fa-chevron-left fa-2x date-arrow" id="dateLeft"></i></a>
                                            </th>
                                            <th colspan="3" class="text-center text-secondary" style="vertical-align: bottom">
                                                <h3 id="date"></h3>
                                            </th>
                                            <th>
                                                <a href="#"> <i class="fa fa-chevron-right fa-pull-right fa-2x date-arrow"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <h6>9:00</h6>
                                            </td>
                                            <td>
                                                <h6>70  Kentucky Street</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6 class="label label-default">Greenlane</h6>
                                            </td>
                                            <td>
                                                <h6>Auckland</h6>
                                            </td>
                                            <td style="width: 20%;">
                                                <a href="#" class="table-link fa-pull-right" data-toggle="collapse" data-target="#demo" id="downButton" on>
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-chevron-down fa-stack-1x fa-inverse more-info" id="arrow"></i>
                                                    </span>
                                                </a>

                                            </td>
                                        </tr>
                                        <tr >
                                            <td colspan="5" style="padding: 0px">
                                                <div class="collapse"  id="demo" style="padding: 10px">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pull-right">
                                <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        n =  new Date();
        y = n.getFullYear();
        m = n.getMonth() + 1;
        d = n.getDate();
        document.getElementById("date").innerHTML = d + "/" + m + "/" + y;

        getButton = document.getElementById('arrow');
        getButton.onmouseup = f;

        theButton = document.getElementById('demo');




        degrees = 0;

        function f(){
            if(!(theButton.classList.contains('collapsing')))
            {
                degrees += 180;
                getButton.style.transform = "rotate("+degrees+"deg)";
                getButton.style.transition = "transform 500ms";
            }

        }
    </script>


@endsection
