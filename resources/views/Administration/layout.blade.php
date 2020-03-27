<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{url('css/Index.css')}}" type="text/css"/>
    <title>@yield('title') - KSPMS</title>
</head>
<body>
<div class="MainCon">
    <div class="header">
        <div class="headerCon">
            <button class="login">Login</button>
            <button class="login">Sign up</button>
        </div>
    </div>
    <hr>
    <div class="homeNav">
        <div class="homeNavCon">
            <ul class="navBar">
                <li class="topNav">
                    <a href="#">Client Management</a>
                </li>
                <li class="topNav">
                    <a href="#">Staff Management</a>
                </li>
                <li class="topNav">
                    <a href="#">Service Provider Management</a>
                </li>
                <li class="topNav">
                    <a href="#">Assignment Management</a>
                </li>
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