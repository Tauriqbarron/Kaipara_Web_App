<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('css/Profile.css')}}">
        <script src="{{url('js/client.js')}}"></script>
    </head>
    <body id="bod">

        @include('Profile.header')
        <div class="MainCon container-fluid">
            {{--@include('Profile.ProfileBar')--}}
            @include('Client.nav')
            <div class="p-5 rounded-bottom bg-white">
                <div class="content">
                    @yield('mainContent')
                </div>
            </div>
            @include('footer')
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script >
            function updateTextInput(val) {
                document.getElementById('textInput').value=val;
            }
            function overviewTextInput(val) {
                document.getElementById('number1').value=val;
            }
            function overviewType(val){
                document.getElementById('type').value=val;
            }

            function overviewStreet(val){
                document.getElementById('street').value =val;
            }
            function overviewSuburb(val){
                document.getElementById('suburb').value =val;
            }
            function overviewCity(val){
                document.getElementById('city1').value =val;
            }
            function overviewPostcode(val){
                document.getElementById('postcode1').value =val;
            }
            function overviewDate(val){
                document.getElementById('date1').value =val;
            }
            function overviewStart(val){
                document.getElementById('startTime').value =val;
            }
            function overviewEnd(val){
                document.getElementById('endTime').value =val;
            }
        </script>
    </body>


</html>

