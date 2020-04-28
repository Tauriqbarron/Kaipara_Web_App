
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

        <div class="row mx-md-n5 ">
            <div class="col px-md-5 "><a href="{{ route('staff.login') }}"  class="btn btn-primary btn-lg col p-3 mb-5 mt-5 h-100 d-flex justify-content-center"><div class='align-self-center'>Security Officer</div></a></div>
            <div class="col px-md-5 "><a href="{{ route('admin.login') }}"  class="btn btn-primary btn-lg col p-3 mb-5 mt-5 h-100 d-flex justify-content-center"><div class='align-self-center'>Administrator</div></a></div>
        </div>
        <div class="fixed-bottom">@include('footer')</div>
    </body>
</html>
