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

        <script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>
    </head>
    <body id="bod" onload="loaded()">
        @include('Security.header')
        <div class="container-fluid" style="min-width: 1200px">
            @include('Security.nav')

            <div class="jumbotron bg-white w-100 h-100 rounded-bottom-lg" style="overflow: hidden;" id="mainContent">
                @yield('mainContent')
            </div>


            @include('Security.footer')


        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoA571QZSNmBnGSO2B0AO6hA1XSlcgicI&callback=initMap" async defer></script>

    </body>

</html>
