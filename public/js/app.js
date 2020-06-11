var map;
var scheduleMap;
var addresses = [];
var n = new Date();
var _scAddresses = [];

//TODO get nav buttons by custom class name and set active
window.addEventListener('load', function() {

    if(window.sessionStorage.getItem('button')){
        pageToggle(window.sessionStorage.getItem('button'),window.sessionStorage.getItem('target'));
    }
    else{
        pageToggle('profileBtn', 'profileContainer')
    }

    var editBtns = document.getElementsByClassName('edit-toggle');

    for(var i = 0; i < editBtns.length; i++){
        editBtns[i].addEventListener('click', function (event) {
            var btn = event.target;
            var id = btn.getAttribute('data-target');
            var input = document.getElementById(id);
            input.classList.remove('form-control-plaintext');
            input.removeAttribute('readonly');
            document.getElementById('btnEditStaff').classList.remove('disabled');
            document.getElementById('btnEditStaff').style.pointerEvents = 'all';
            btn.classList.remove('text-secondary');
            btn.style.pointerEvents = 'none';
        });
    }

    var pageToggleBtns = document.getElementsByClassName('page-toggle-btn');

    Array.prototype.filter.call(pageToggleBtns, function (btn) {
        btn.addEventListener('click', function () {
            var targetID = btn.getAttribute('data-target');
            var target = document.getElementById(targetID);
            var pages = document.getElementsByClassName('page-toggle-page');
            Array.prototype.filter.call(pageToggleBtns, function (b) {
                b.classList.remove('active');
            });
            Array.prototype.filter.call(pages, function (page) {
                page.style.display = 'none';
            });

            btn.classList.add('active');
            target.style.display = 'block';

        }, false);
    });

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}, false);


function dateValidation(sender) {
    console.log(sender.value);
    console.log(document.getElementById("alEndDate").min);
    document.getElementById("alEndDate").min = sender.value;
    console.log('after: '+document.getElementById("alEndDate").min);
}

function alToggle() {
    //do something
    pages = document.getElementsByClassName('annual-leave-page');

    for(i = 0; i < pages.length; i++){
        pages[i].classList.toggle('al-hidden');
    }
    btns = document.getElementsByClassName('alBtn');

    for(i = 0; i < btns.length; i++){
        btns[i].classList.toggle('disabled');
    }
}
function loaded(){

}

function setAddresses(scAddresses){
    _scAddresses = scAddresses;

}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -36.8742039, lng: 174.809371},
        zoom: 10
    });
    addresses.forEach(getMarker);

    scheduleMap = new google.maps.Map(document.getElementById('scheduleMap'), {
        center: {lat: -36.8742039, lng: 174.809371},
        zoom: 10
    });

    _scAddresses.forEach(getScheduleMarker);



}

function addAddress(address){
    addresses.push(address);
}

//getMarker(string: address)
//converts an address string to lat and lng co-ordinates and places a marker on the map
//Code by rafon: https://stackoverflow.com/questions/46868703/google-maps-api-add-marker-by-address-javascript/46906152
function getMarker(address) {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            //map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location

            });


        }
    });

}

function getScheduleMarker(address) {
    console.log(address);
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            scheduleMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: scheduleMap,
                position: results[0].geometry.location

            });
        }
    });

}

function setScheduleCenter(address){

    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            scheduleMap.setCenter(results[0].geometry.location);
            scheduleMap.setZoom(12);

        }
    });
}
function setCenter(address){

    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            map.setZoom(12);

        }
    });
}

function f(button, target){
    theButton = document.getElementById(button);
    theTarget = document.getElementById(target);

    if(!(theTarget.classList.contains('collapsing')))
    {
        degrees = getRotation(theButton);
        degrees += 180;
        if(degrees < 0){
            degrees--;
        }
        theButton.style.transform = "rotate("+degrees+"deg)";
        theButton.style.transition = "transform 300ms";
    }

}


function getRotation(element){
    var st = window.getComputedStyle(element, null);
    var tr = st.getPropertyValue("-webkit-transform") ||
        st.getPropertyValue("-moz-transform") ||
        st.getPropertyValue("-ms-transform") ||
        st.getPropertyValue("-o-transform") ||
        st.getPropertyValue("transform") ||
        "FAIL";

    var values = tr.split('(')[1].split(')')[0].split(',');
    var a = values[0];
    var b = values[1];
    var c = values[2];
    var d = values[3];

    var scale = Math.sqrt(a*a + b*b);
// arc sin, convert from radians to degrees, round
    var sin = b/scale;

    return Math.round(Math.atan2(b, a) * (180 / Math.PI));
}

function pageToggle(button, target){
    pages = document.getElementsByClassName('page-toggle-page');

    btns = document.getElementsByClassName('page-toggle-btn');

    for(i = 0; i < pages.length; i+=1){
        pages[i].style.display = 'none';
    }

    for(i = 0; i < btns.length; i+=1){
        btns[i].classList.remove('active');
    }

    document.getElementById(button).classList.add('active');
    document.getElementById(target).style.display = 'block';

    window.sessionStorage.setItem('button', button);
    window.sessionStorage.setItem('target', target);

}

function updateTextInput(val) {
    document.getElementById('textInput').value=val;
}


function clearSession() {
    window.sessionStorage.clear();
}
