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
        <form class="w-75 mx-auto" role="form" method="POST" action="{{route('service.login.submit')}}">
            <a class="btn btn-secondary" href="{{URL::previous()}}">Back</a>
            <h1 class="form-group ">Service Provider Login</h1>
            {{csrf_field()}}
            @if ($message = Session::get('error'))
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
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input id="email" name="email" type="email" class="form-control"  aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input id="password" name="password" type="password" class="form-control" >
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary shadow" value="login">Submit</button>
                <a class="btn btn-link" href="{{route('sp.password.request')}}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>

        </form>


        <div class="fixed-bottom">@include('footer')</div>
    </body>
</html>

