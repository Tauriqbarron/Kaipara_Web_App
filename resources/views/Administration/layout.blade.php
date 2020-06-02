<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{url('css/Index.css')}}" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @yield('script')
    <title>@yield('title') - KSPMS</title>

</head>
<body>
<div class="MainCon">
    @include('Administration.header')
    <div>
    @include('Administration.nav')
    </div>
    <div class="content">
        @yield('mainContent')
    </div>
    <div style="margin-top: 300px">
    @include('footer')
    </div>
</div>
</body>
</html>
