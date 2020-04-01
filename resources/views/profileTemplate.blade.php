<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{url('css/Index.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{url('css/Profile.css')}}" type="text/css"/>
    <title>@yield('title') - KSPMS</title>
</head>
<body>
<div class="MainCon">
    <div class="header">
        <div class="headerCon">
            <button class="login">Settings</button>
            <button class="login">Log Out</button>
        </div>
    </div>
    <hr>
    <div class="profileBarCon">
        <ul class="profileBar">
            <li class="profilePicCon">
                    <img src="" style="width:100%">
            </li>
            <li class="contextMenuCon">
                    <img src="contextMenu.png" style="width:100%">
            </li>

        </ul>
    </div>
    <hr>
    <div class="homeNav">
        <div class="homeNavCon">
            <ul class="navBar">
                <li class=topNav>Map</li>
                <li class="topNav">@yield('topNav1')</li>
                <li class="topNav">@yield('topNav2')</li>
                <li class="topNav">@yield('topNav3')</li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="content">
        @yield('mainContent')
    </div>
    <div class="footerCon">
        <div class="footer">
            <ul class="footerLinks">
                <li>Contact Us</li>
                <li>About Us</li>
                <li>Terms and Conditions</li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
