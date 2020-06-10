<nav class="navbar navbar-expand-lg navbar-light bg-white d-flex">
    </s>
    <a href="{{url('/')}}" class="mr-auto pHeader"><img src="{{url('images/KaiparaLogo.png')}}" alt="" ></a>
    <i class="fas fa-cog align-self-start mt-3"></i>
    <h5 class="text-primary mx-5 align-self-start"></h5>
    <p>{{auth()->guard('admin')->user()->name}}</p>
    <a href="{{route('admin.logout')}}" class="btn btn-primary  mx-1 align-self-start">Log out</a>
</nav>
