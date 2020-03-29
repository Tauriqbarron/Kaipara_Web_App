<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{url('css/Index.css')}}" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>
    <title>@yield('title') - KSPMS</title>
    @yield('styles')
</head>
<body>
    <div class="MainCon">
        @include('header')
        <div class="w-auto overflow-hidden " style=" height:400px ">
            <img src="https://live.staticflickr.com/932/40955356234_efc310429f_k.jpg" class="img-fluid " alt="Responsive image">
        </div>
        @include('nav')

        <div class="content">
            @yield('mainContent')
        </div>
        @include('footer')
    </div>
</body>
</html>

