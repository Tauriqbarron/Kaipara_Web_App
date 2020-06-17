<nav class="navbar navbar-dark bg-dark navbar-expand-sm justify-content-center">
    <a href="{{route('service.home')}}" id="profileBtn"><img  src="{{url('images/Dashboard_active.png')}}" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 ">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('service.applications')}}" >Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('service.jobs')}}">Ongoing Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('service.completed_jobs')}}">Completed Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('service.view_quote')}}">Quotes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Availability Schedule</a>
            </li>
        </ul>
    </div>
    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
        <li class="nav-item">
            <a class="nav-link" href="{{route('service.postEdit')}}">Settings</a>
        </li>
    </ul>
</nav>
