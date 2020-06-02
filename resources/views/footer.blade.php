<nav class="navbar  navbar-light justify-content-end mt-1 footer" id="mainFooter">
    <nav class="nav flex-column justify-content-end">
        <a class="nav-link active" href="#">Contact Us</a>
        <a class="nav-link active" href="#">About Us</a>
        <a class="nav-link active" href="#">Terms and Conditions</a>
        @if(!(\Illuminate\Support\Facades\Auth::check()))
            <a class="nav-link active" href="{{url('/selectstaff')}}">Staff Entrance</a>
        @endif
        <small class="d-block mb-3 text-muted">&copy;2020 Tauriq&Sam&Jay</small>
    </nav>
</nav>
