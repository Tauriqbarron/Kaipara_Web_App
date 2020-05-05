<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex shadow">
    <img src="{{url('images/KaiparaLogo.png')}}" alt="" class=" mr-auto">
    <a href="{{route('admin.index')}}" class="btn btn-primary  mx-1 align-self-start shadow">Admin</a>
    <a href="{{ url('/selectuser') }}" class="btn btn-primary  mx-1 align-self-start shadow">Login</a>
    <a href="{{ url('/registration/usertype') }}" class="btn btn-primary  mx-1 align-self-start shadow">Sign up</a>
</nav>
