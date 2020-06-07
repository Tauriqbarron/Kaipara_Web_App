<!--<nav class="navbar navbar-expand-lg navbar-light bg-white d-flex">
    <img src="{{url('images/KaiparaLogo.png')}}" alt="" class=" mr-auto pHeader">
    <i class="fas fa-cog align-self-start mt-3"></i>
    <a href="{{route('staff.logout')}}" class="btn btn-primary  mx-1 align-self-start">Log out</a>
</nav>-->
<div class="shadow">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg justify-content-left"  style="padding: 5px">
            <a href="/" class="navbar-brand d-flex w-50 mr-auto">
                <img id="kaiparaLogo" src="{{url('images/KaiparaLogo.png')}}" class="mr-auto float-left">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse w-100 align-items-end" id="collapsingNavbar3" >
                @if($guard != 'none')
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end  dropdown">
                        <li class="nav-item border-0 "  >
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" style="cursor:pointer;">
                                @if(auth()->guard('admin')->check())
                                    {{auth()->guard('admin')->user()->name}}
                                @elseif($guard === 'service_provider')
                                    {{auth()->guard($guard)->user()->firstname}} {{auth()->guard($guard)->user()->lastname}}
                                @else
                                    {{auth()->guard($guard)->user()->first_name}} {{auth()->guard($guard)->user()->last_name}}
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownMenuButton">
                                @if(Auth::guard('staff')->check())
                                    <a class="dropdown-item" href="{{route('security.index')}}">My Profile</a>
                                    <a class="dropdown-item" href="{{route('staff.logout')}}">Logout</a>
                                @elseif(Auth::guard('service_provider')->check())
                                    <a class="dropdown-item" href="{{route('service.home')}}">My Profile</a>
                                    <a class="dropdown-item" href="{{route('service.logout')}}">Logout</a>
                                @elseif(Auth::guard('admin')->check())
                                    <a class="dropdown-item" href="{{route('admin.index')}}">Administration Center</a>
                                    <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
                                @else
                                    <a class="dropdown-item" href="{{route('client.home')}}">My Profile</a>
                                    <a class="dropdown-item" href="{{route('client.logout')}}">Logout</a>
                                @endif
                            </div>
                        </li>
                        <li class="nav-item" id="headerProfileImage">
                            <img class="float-right rounded-circle shadow dropdown-toggle text-nowrap" style="display: block; width: 54px; height: 54px" src="@if($guard == 'admin' || $guard == 'clients' || $guard === 'service_provider'){{url('images/Profile_Placeholder.png')}}@else{{auth()->guard($guard)->user()->imgPath}}@endif" alt="clientProfileImage">
                        </li>
                    </ul>

                @else
                    @php(session()->put('error', 'You must be logged in to view this page'))
                    <script type="text/javascript">
                        window.location = "{{url('/selectuser')}}"
                    </script>

                @endif
            </div>
        </nav>
    </div>
</div>
