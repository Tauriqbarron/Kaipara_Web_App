<nav class="navbar navbar-dark bg-dark navbar-expand-sm justify-content-center">
    <a href="#" id="profileBtn"><img src="https://vectr.com/samjcribb/a25QhH2un.svg?width=107.46333333333331&height=23.999999999999943&select=de8GXLBTc&source=selection" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 ">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{ url('/service/applications')}}" >Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/service/jobs')}}">Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('service.view_quote')}}">Quotes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Availability Schedule</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
        </ul>
    </div>
    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
        <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
        </li>
    </ul>
</nav>
