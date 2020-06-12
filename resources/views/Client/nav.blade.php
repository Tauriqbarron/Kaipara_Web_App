{{--<nav class="navbar navbar-dark bg-secondary text-light justify-content-center">
    <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
        <li class="nav-item">
            <a class="nav-link" href="{{route('client.security')}}">Security</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('client.property')}}">Property Management</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Service Jobs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Security Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Quotes</a>
        </li>

    </ul>

</nav>--}}
<nav class="navbar navbar-dark bg-dark navbar-expand-sm justify-content-center">
    <a href="#" id="profileBtn"><img  src="{{url('images/Dashboard_active.png')}}" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 " id="collapsingNavbar3">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{route('client.security')}}" >Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.property')}}">Property Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Service Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Security Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Quotes</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link" id="txtUsername" href="#">Settings</a>
            </li>
        </ul>
    </div>
</nav>
