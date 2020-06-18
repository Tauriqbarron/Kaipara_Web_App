<!DOCTYPE html>
<html>
    <head>
        <title>@yield('pageTitle') | Kaipara Security and Property Management Services</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{url('css/Profile.css')}}" type="text/css"/>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Asap:700&display=swap" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('js/app.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
        <style>
            #profileBtn,
            #profileBtn:active:hover {
                content: url("{{url('images/Dashboard_inactive.png')}}");
            }
            #profileBtn:hover,
            #profileBtn.active{
                cursor: pointer;
                content: url("{{url('images/Dashboard_active.png')}}");
            }
            .page-toggle-btn.active{
                pointer-events: none;
            }


        </style>

        <!--<script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>-->


    </head>
    <body id="bod">
    @foreach($completedBookings as $booking)
        @if($staff_assignment = $booking->staff_assignments->where('staff_id', '=', $staff->id)->first())
            <div class="modal" id="f{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="modalTestLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form  method="POST" action="{{route('staff.postFeedback')}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-client-image">
                                    <img src="{{url('images/Profile_Placeholder_Large.jpg')}}" class="rounded-circle w-100" alt="Client Image" >
                                </div>
                                <div style="width: 300px; float: right">
                                    <h5 class="modal-title" id="modalTestLabel">{{$booking->description}}</h5>
                                    <h5 class="modal-title" id="modalTestLabel">Client: {{$booking->client->first_name}} {{$booking->client->last_name}}</h5>
                                    <label for="staff_assignment_id">Staff Assignment ID: {{$staff_assignment->id}} </label><input id="staff_assignment_id" name="staff_assignment_id" value="{{$staff_assignment->id}}" type="hidden">
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label for="rating">Rating:</label>
                                </div>
                                <div class="rating btn-group form-group" id="rating" role="group">
                                    <input type="radio" name="star" id="{{$booking->id}}star5" value="5"><label for="{{$booking->id}}star5"></label>
                                    <input type="radio" name="star" id="{{$booking->id}}star4" value="4"><label for="{{$booking->id}}star4"></label>
                                    <input type="radio" name="star" id="{{$booking->id}}star3" value="3"><label for="{{$booking->id}}star3"></label>
                                    <input type="radio" name="star" id="{{$booking->id}}star2" value="2"><label for="{{$booking->id}}star2"></label>
                                    <input type="radio" name="star" id="{{$booking->id}}star1" value="1"><label for="{{$booking->id}}star1"></label>
                                </div>
                                <div>
                                    <label for="messageBox">Message:</label>
                                </div>
                                <div>
                                    <textarea name="message" class="float-left w-100" id="messageBox" rows="5" maxlength="300"></textarea>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit Feedback</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
    <?php
    $addresses = array();
    foreach($bookings as $booking){
        $addressString = $booking->street.", ".$booking->suburb.", ".$booking->city.", New Zealand";

        array_push($addresses, $addressString);
    }
    ?>

    <script>
        setBookings({!! json_encode($allBookings) !!}, {!! json_encode($staff_assignments) !!}, {!! json_encode($staff->leave_requests) !!});
        setAddresses({!! json_encode($addresses)!!});
        setWeek("{!! \Carbon\Carbon::parse(session()->get('weekStart'))->format('Y-m-d') !!}", "{!! \Carbon\Carbon::parse(session()->get('weekEnd'))->format('Y-m-d') !!}");
    </script>
        @include('Security.header')
        <div class="container-fluid" style="min-width: 1200px">
            @include('Security.nav')

            <div class="jumbotron bg-white w-100 h-100 rounded-bottom-lg" style="overflow: hidden; padding-top: 32px" id="mainContent">
                @yield('mainContent')
            </div>


            @include('Security.footer')


        </div>

        {!! $calendar->script() !!}

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoA571QZSNmBnGSO2B0AO6hA1XSlcgicI&callback=initMap" async defer></script>

    </body>

</html>
