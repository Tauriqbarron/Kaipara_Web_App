<!DOCTYPE html>
<html>
<head>
    {{--<link rel="stylesheet" href="{{url('css/Index.css')}}" type="text/css"/>--}}
    <link rel="stylesheet" href="{{url('css/Profile.css')}}" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c3929064ae.js" crossorigin="anonymous"></script>

    <title>@yield('title') - KSPMS</title>
    @yield('styles')
</head>
<body>

<div class="container-fluid">
    @if ($message = session()->pull('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <strong>{{$message}}</strong>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <p class="text-center" style="font-size: 20px"><strong>Please select your account type.</strong></p>

    </div>
    <a class="btn btn-secondary mt-1" href="{{url('/')}}">Back</a>
    <div class="row mx-md-n5 ">
        <div class="col px-md-5 "><a href="{{route('reg.client.1')}}"  class="btn btn-primary btn-lg col p-3 mb-5 mt-5 h-100 d-flex justify-content-center"><div class='align-self-center'>Client</div></a></div>
        <div class="col px-md-5 "><a href="{{ url('service_provider/registration/servicepage1') }}"  class="btn btn-primary btn-lg col p-3 mb-5 mt-5 h-100 d-flex justify-content-center"><div class='align-self-center'>Service Provider</div></a></div>
    </div>
    <div class="fixed-bottom">@include('footer')</div>
</div>
</body>
</html>


