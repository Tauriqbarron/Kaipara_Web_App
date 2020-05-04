<nav class="navbar navbar-dark bg-dark navbar-expand-sm justify-content-center">
    <a href="{{route('security.page',['pageString' => 'profile'])}}"><img src="https://vectr.com/samjcribb/a25QhH2un.svg?width=107.46333333333331&height=23.999999999999943&select=de8GXLBTc&source=selection" class="navbar-brand d-flex mr-auto text-light">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h4 class="navbar-brand w-25"></h4>
    <div class="navbar-collapse collapse w-100 " id="collapsingNavbar3">
        <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
            <li class="nav-item" >
                <a class="nav-link" href="{{route('security.page',['pageString' => 'profile'])}}">Schedule</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Assignments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Roster</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
            <li class="nav-item">
                <a class="nav-link" id="txtUsername" href="#">Settings</a>
            </li>
        </ul>
    </div>
</nav>
