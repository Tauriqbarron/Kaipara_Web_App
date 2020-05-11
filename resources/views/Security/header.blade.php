<div class="shadow">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg justify-content-left"  style="padding: 5px">
            <a href="/" class="navbar-brand d-flex w-50 mr-auto">
                <img id="kaiparaLogo" src="{{url('images/KaiparaLogo.png')}}" class="mr-auto float-left">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse w-100 align-items-end" id="collapsingNavbar3">
                <ul class="navbar-nav w-100 h-100 justify-content-center text-nowrap align-items-end">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Security Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Property Management Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
                    <li class="nav-item dropdown border-0 ">
                            <button class="btn-light rounded border-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$staff->first_name}} {{$staff->last_name}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('staff.logout')}}">Logout</a>
                            </div>
                    </li>
                    <li class="nav-item" id="headerProfileImage">
                        <img class="float-right rounded-circle shadow" style="display: block; width: 54px; height: 54px" src="{{url('images/Profile_Placeholder_large.jpg')}}" alt="profileImage">
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
