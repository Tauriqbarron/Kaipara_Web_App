<html>
    <head>
        <link rel="stylesheet" href="{{url('css/Index.css')}}" type="text/css"/>
        <link rel="stylesheet" href="{{url('css/registration.css')}}" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>
        <title>@yield('title') - KSPMS</title>
        @yield('styles')
    </head>
    <body>
        @include('header')
        <div class="my-5">
            <div class="regformcontainer mx-auto">
                @include('Registration.regform')
            </div>
        </div>
        @include('footer')
    </body>
</html>



