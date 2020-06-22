<div class="shadow w-100 header-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg navbar-expand-md navbar-expand-sm justify-content-left"  style="padding: 5px">
            <a href="{{url('/')}}" class="navbar-brand d-flex w-50 mr-auto" onclick="clearSession()" >
                <img id="kaiparaLogo" src="{{url('images/KaiparaLogo.png')}}" class="mr-auto float-left">
            </a>
                @if(auth()->guard('staff')->check())
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end  dropdown">
                        <li class="nav-item border-0 ">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-target="#logoutMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" style="cursor:pointer;">
                                {{auth()->guard('staff')->user()->first_name}} {{auth()->guard('staff')->user()->last_name}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right rounded-0" id="logoutMenu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('security.index')}}">My Profile</a>
                                <a class="dropdown-item" href="{{route('staff.logout')}}">Logout</a>
                            </div>
                        </li>
                        <li class="nav-item" id="headerProfileImage">
                            <img class="float-right rounded-circle shadow dropdown-toggle" style="display: block; width: 54px; height: 54px" src="{{url(isset($staff->imgPath) ? $staff->imgPath : 'images/Profile_Placeholder.png' )}}" alt="profileImage">
                        </li>
                    </ul>

                    @else
                    @php(\Illuminate\Support\Facades\Session::put('error','You must be logged in to view this page'))
                <script type="text/javascript">
                    window.location = '{{url('/security/login')}}'
                </script>

                @endif
        </nav>
    </div>
</div>
