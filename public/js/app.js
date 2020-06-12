var map;
var scheduleMap;
var addresses = [];
var n = new Date();
var _scAddresses = [];
var _bookings = [];
var timetableArray = [];
var week = [];
var leaveArray = [];
//TODO get nav buttons by custom class name and set active
window.addEventListener('load', function() {
    createTimetable();
    var monthbtn = document.getElementsByClassName('fc-month-button')[0];
    monthbtn.click();

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
            window.sessionStorage.setItem('button', btn.getAttribute('id'));
            window.sessionStorage.setItem('target', targetID);

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

function setBookings(array, saArray, lArray) {
    _bookings = array;
    leaveArray = lArray;
    $.each(array, function (key, value) {
        id = value['id'];
        date = value['date'];
        startTime = value['start_time'];
        finishTime = value['finish_time'];
        statusTime = value['finish_time'];
        staffNeeded = value['staff_needed'];
        availableSlots = value['available_slots'];

        if (saArray.includes(id)){
            timetableArray.push(value);
        }

    });


}

function setWeek(start_date, end_date) {
    week  = [new Date(start_date), new Date(end_date)];
}


function createTimetable() {

    timetable = [];
    //Filter out the records to display
    filteredArray = timetableArray.filter(function (value) {
        var date = new Date(value['date']);
        return date >= week[0] && date <= week[1];

    });

    //Filter the leave records
    filteredLeaveArray = [];
    for (var leave of leaveArray){
        leaveStart = new Date(leave['start_date']);
        leaveEnd = new Date(leave['end_date']);
        weekStart = week[0];
        weekEnd = week[1];

        days = (leaveEnd-leaveStart)/1000/60/60/24;
        //Iterate through the date range and create array records to populate the table
        if (leave['absence_status_id'] === 2){
            for (i = 0; i < days; i++){
                //TODO better variable name
                bleh = new Date(leaveStart);
                bleh.setDate(bleh.getDate()+i);

                if (bleh >= weekStart && bleh <= weekEnd && bleh <= leaveEnd){
                    filteredLeaveArray.push([
                        10,
                        '',
                        'Annual Leave',
                        bleh.getFullYear() + "-" + (bleh.getMonth()+1) + "-" + bleh.getDate(),
                        "#3d8fd1"

                    ]);
                }
            }
        }



    }
    start = Math.floor(Math.min.apply(Math, filteredArray.map(function (record) {
        return record['start_time'];
    })));

    finish = Math.ceil(Math.max.apply(Math,filteredArray.map(function (record) {
        return record['finish_time'];
    })));

    hours = finish - start;

    if (!(hours > 0)){
        hours = 12;
        start = 8;
        finish = 16;
    }


    //fill in the times for the first column
    for (i = 0; i < hours; i++){
        timetable[i] = [];
        leading = '0';
        if( (i + start) >= 10){
            leading = '';
        }

        hhmm = (leading + (i + start).toFixed(2)).replace('.', ':');

        timetable[i].push(hhmm);
    }

    //populate the table with empty cells

    for (hour = 0; hour < hours; hour++){
        for (day = 1; day < 8; day++){
            timetable[hour][day] = [];
            timetable[hour][day].push(['empty']);
        }
    }

    //loop through the timetable bookings array and add the records to the timetable
    $.each(filteredLeaveArray, function (key, value) {
        hours = value[0];
        j = new Date(value[3]).getDay()+1;
        i = Math.floor(9-start);

        timetable[i][j] = [value[0], value[1], value[2], value[3], value[4]];

        for(k = 1; k < hours; k++){
            timetable[i+k][j] = ['full'];
        }

    });

    //loop through the timetable bookings array and add the records to the timetable
    $.each(filteredArray, function (key, value) {


        hours = Math.floor(value['finish_time'] - value['start_time']);
        j = new Date(value['date']).getDay()+1;
        i = Math.floor(value['start_time']-start);
        leading = '0';
        if( (value['start_time']) >= 10){
            leading = '';
        }
        starthhmm = (leading + value['start_time'].toFixed(2)).replace('.', ':');
        leading = '0';
        if( (value['finish_time']) >= 10){
            leading = '';
        }
        finishhhmm = (leading + value['finish_time'].toFixed(2)).replace('.', ':');

        timetable[i][j] = [hours, starthhmm + " - " + finishhhmm, value['description'], value['date'], "#dd504c"];


        for(k = 1; k < hours; k++){
            timetable[i+k][j] = ['full'];
        }

    });

    //console.log(timetable);

    //Create the table
    table = document.createElement('table');
    table.classList.add('table', 'border', 'w-100');
    table.style.tableLayout = 'fixed';
    //Define headings
    headings = ["Time", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    //Create the table head
    thead = document.createElement('thead');
    topRow = thead.insertRow();
    leftTh = document.createElement('th');
    leftArrow = document.createElement('i');
    leftArrow.classList.add('fa', 'fa-chevron-left', 'date-arrow');
    leftArrow.addEventListener('click', function () {
        var newStart = week[0].setDate(week[0].getDate() - 7);
        var newFinish = week[1].setDate(week[1].getDate() - 7);

        setWeek(newStart, newFinish);
        document.getElementById('timetableContainer').removeChild(table);
        createTimetable();

    });
    leftTh.appendChild(leftArrow);
    topRow.appendChild(leftTh);
    midTh = document.createElement('th');
    midTh.colSpan = 6;
    midTh.classList.add('text-center', 'text-secondary');
    midTh.style.verticalAlign = 'bottom';
    title = document.createElement('h5');
    title.classList.add('mb-0');
    title.innerHTML = week[0].getDate() + "/" + (week[0].getMonth()+1) + "/" + week[0].getFullYear() + " - " + week[1].getDate() + "/" + (week[1].getMonth()+1) + "/" + week[1].getFullYear();
    midTh.appendChild(title);
    topRow.appendChild(midTh);
    rightTh = document.createElement('th');
    rightArrow = document.createElement('i');
    rightArrow.classList.add('fa', 'fa-chevron-right', 'date-arrow', 'float-right');
    rightArrow.addEventListener('click', function () {
        var newStart = week[0].setDate(week[0].getDate() + 7);
        var newFinish = week[1].setDate(week[1].getDate() + 7);

        setWeek(newStart, newFinish);
        document.getElementById('timetableContainer').removeChild(table);
        createTimetable();

    });
    rightTh.appendChild(rightArrow);
    topRow.appendChild(rightTh);



    //Add a row for headings
    headRow = thead.insertRow();
    for (var h of headings){
        th = document.createElement('th');
        th.innerHTML = h;
        headRow.append(th);
    }
    //Add thead to the table
    table.appendChild(thead);
    //Create the table body
    tbody = document.createElement('tbody');
    for (var row of timetable){
        //console.log('Row: ' + row);
        //Add a row
        newRow = tbody.insertRow();
        for (var col of row){
            //console.log('Col: ' + col);
            //Add a cell to the row and define the contents
            if(col[0] !== 'full') {
                if (col === row[0]) {
                    cell = newRow.insertCell();
                    cell.classList.add('border');
                    cell.innerHTML = col;
                    cell.style.width = '5%';
                } else if (col == 'empty') {
                    cell = newRow.insertCell();
                    cell.classList.add('border-light', 'bg-white');
                    cell.style.width = '13%';
                } else if(col[0] > 0){
                    cell = newRow.insertCell();
                    cell.rowSpan = col[0];
                    cell.classList.add('text-center', 'text-light', 'rounded-lg', 'border', 'border-white');
                    cell.style.backgroundColor = col[4];
                    cell.style.width = '13%';
                    cell.innerHTML = "<strong>" + col[2] + "<br>" + col[1] + "<br>" + col[3] + "</strong>";
                }
            }

        }

    }

    table.appendChild(tbody);

    document.getElementById('timetableContainer').appendChild(table);

}

function dateValidation(sender) {
    document.getElementById("alEndDate").min = sender.value;
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
