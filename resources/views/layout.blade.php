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
        <script src="{{url('js/app.js')}}"></script>

        <script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>

        <title>@yield('title') - KSPMS</title>
        @yield('styles')
        @php
            $guard = 'none';
            if(auth()->guard('staff')->check()){
                $guard = 'staff';
            }elseif(auth()->guard('clients')->check()){
                $guard = 'clients';
            }elseif(auth()->guard('admin')->check()){
                $guard = 'admin';
            }elseif(auth()->guard('service_provider')->check()){
                $guard = 'service_provider';
            }
        @endphp
    </head>
<body style="margin-top: 0px">
    <div class="MainCon ">
        @include('header')
        <div class="container-fluid">
        <div class="w-auto overflow-hidden bg-dark" style=" height:400px ">
                <img src="https://live.staticflickr.com/932/40955356234_efc310429f_k.jpg" id="img_waterfall" class="img-fluid " alt="Responsive image">

                <div class="caption">
                    <h1 class="text-center">Our Services</h1>
                </div>
        </div>

            @include('nav')
        <div class="content jumbotron rounded-bottom">
            @yield('mainContent')
        </div>
        @include('footer')
        </div>
    </div>
</body>
</html>

