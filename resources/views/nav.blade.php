<nav class="navbar navbar-dark bg-dark navbar-expand-sm justify-content-center">
        <ul class="navbar-nav w-100 justify-content-center text-nowrap">
            <li class="nav-item" >
                <a class="nav-link @yield('security')" href="{{url('/')}}" id="scheduleBtn">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('service')" href="{{url('/our_services')}}" id="assignmentBtn">Service</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('news')" href="{{url('/news')}}" id="rosterBtn">News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('about')" href="{{url('/about')}}">About Us</a>
            </li>
        </ul>
</nav>

