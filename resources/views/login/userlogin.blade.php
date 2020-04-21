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
<form>
    <div class="form-group w-75 mx-auto">
        {{csrf_field()}}

        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group w-75 mx-auto">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group w-75 mx-auto">
        <button type="submit" class="btn btn-primary shadow">Submit</button>
    </div>
</form>


<div class="fixed-bottom">@include('footer')</div>
</body>
</html>

