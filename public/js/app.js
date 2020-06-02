var map;
var scheduleMap;
var addresses = [];
var n = new Date();
var _scAddresses = [];


function loaded(){
    if(window.sessionStorage.getItem('button')){
        pageToggle(window.sessionStorage.getItem('button'),window.sessionStorage.getItem('target'));
    }
    else{
        pageToggle('profileBtn', 'profileContainer')
    }
}

function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
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

// With rotate(30deg)...
// matrix(0.866025, 0.5, -0.5, 0.866025, 0px, 0px)
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
    profilePage = document.getElementById('profileContainer').style;
    assignmentPage = document.getElementById('assignmentContainer').style;
    schedulePage = document.getElementById('scheduleContainer').style;
    rosterPage = document.getElementById('rosterContainer').style;

    profileBtn = document.getElementById('profileBtn').classList;
    scheduleBtn = document.getElementById('scheduleBtn').classList;
    assignmentBtn = document.getElementById('assignmentBtn').classList;
    rosterBtn = document.getElementById('rosterBtn').classList;

    pages = [profilePage,assignmentPage,schedulePage,rosterPage];

    btns = [profileBtn, scheduleBtn, assignmentBtn, rosterBtn];

    for(i = 0; i < pages.length; i+=1){
        pages[i].display = 'none';
    }

    for(i = 0; i < btns.length; i+=1){
        btns[i].remove('active');
    }

    document.getElementById(button).classList.add('active');
    document.getElementById(target).style.display = 'block';

    window.sessionStorage.setItem('button', button);
    window.sessionStorage.setItem('target', target);

}

function updateTextInput(val) {
    document.getElementById('textInput').value=val;
}


function clearSession(){
    window.sessionStorage.clear();
}
