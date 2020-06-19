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
            <a class="nav-link" href="{{route('client.quotes')}}">Quotes</a>
        </li>

    </ul>

</nav>--}}
<nav class="navbar navbar-dark bg-dark navbar-expand-sm justify-content-center">
   @yield('nav')
</nav>
