<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{url('css/Profile.css')}}" type="text/css"/>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Asap:700&display=swap" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="{{url('js/indexMap.js')}}" type="text/javascript"></script>


        <title>@yield('title') - KSPMS</title>
        @yield('styles')
    </head>
<body style="margin-top: 0px">
    <div class="MainCon ">
        @include('header')
        <div class="container-fluid">
        <div class="w-auto overflow-hidden bg-dark" style=" height:400px ">
                <img src="https://live.staticflickr.com/932/40955356234_efc310429f_k.jpg" id="img_waterfall" class="img-fluid " alt="Responsive image">

                <div class="caption">
                    <h1 class="text-center">@yield('title2')</h1>
                </div>
        </div>

            @include('nav')
        <div class="content jumbotron rounded-bottom">
            @yield('mainContent')
        </div>
        @include('footer')
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoA571QZSNmBnGSO2B0AO6hA1XSlcgicI&callback=initMap" async defer></script>
</body>
</html>

