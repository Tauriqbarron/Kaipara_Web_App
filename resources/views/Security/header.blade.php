<div class="shadow">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg justify-content-left"  style="padding: 5px">
            <a href="/" class="navbar-brand d-flex w-50 mr-auto" onclick="clearSession()" >
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
                @if(auth()->guard('staff')->check())
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end  dropdown">
                        <li class="nav-item border-0 ">
                            <!--TODO: figure out why the dropdown only works once-->
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-target="#logoutMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" style="cursor:pointer;">
                                {{auth()->guard('staff')->user()->first_name}} {{auth()->guard('staff')->user()->last_name}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right rounded-0" id="logoutMenu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('security.index')}}">My Profile</a>
                                <a class="dropdown-item" href="{{route('staff.logout')}}">Logout</a>
                            </div>
                        </li>
                        <li class="nav-item" id="headerProfileImage">
                            <img class="float-right rounded-circle shadow dropdown-toggle" style="display: block; width: 54px; height: 54px" src="{{url('images/Profile_Placeholder_large.jpg')}}" alt="profileImage">
                        </li>
                    </ul>

                    @else
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
                        <li class="nav-item border-0">
                            <a href="{{route('admin.index')}}" class="btn btn-dark  mx-1 align-self-start shadow">Admin</a>
                        </li>
                        <li>
                            <a href="{{ url('/selectuser') }}" class="btn btn-dark  mx-1 align-self-start shadow">Login</a>
                        </li>
                        <li>
                            <a href="{{ url('/registration/usertype') }}" class="btn btn-dark  mx-1 align-self-start shadow">Sign up</a>
                        </li>
                    </ul>

                @endif
            </div>
        </nav>
    </div>
</div>
