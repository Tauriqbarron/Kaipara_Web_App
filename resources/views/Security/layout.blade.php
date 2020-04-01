<!DOCTYPE html>
<html>
    <head>
        <title>@yield('pageTitle') | Kaipara Security and Property Management Services</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{url('css/Profile.css')}}" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Asap:700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>
    </head>
    <body >
        <div class="container-fluid">
            @include('Security.header')
            @include('Security.nav')
            <div class="jumbotron bg-white w-100 h-100 rounded">
                @yield('mainContent')
            </div>
            @include('Security.footer')


        </div>
    </body>

</html>
