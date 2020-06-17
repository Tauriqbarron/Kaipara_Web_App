//Client Specific functions
const priceCallback = function () {
    try{
        let rate = document.getElementById('officeType').options[document.getElementById('officeType').selectedIndex].getAttribute('data-rate');
        let guards = document.getElementById('number1').value;
        let date1 = document.getElementById('txtStartDate').value;
        let date2;
        try{
            date2 = document.getElementById('txtEndDate').value;
        }catch (e){
            date2 = document.getElementById('txtStartDate').value;
        }
        let days = (getDateDifference(new Date(date1), new Date(date2))+1);
        let s = '';
        let ss = '';
        let ea = '';
        if(days > 1)s='s';
        if(guards > 1){
            ss='s';
            ea = '(each)';
        }
        let startTime = document.getElementById('txtStartTime').value;
        let endTime = document.getElementById('txtEndTime').value;
        let price = calcPrice(rate,guards, new Date(date1), new Date(date2), timeToRealFloat(startTime),timeToRealFloat(endTime));
        let exp = document.getElementById('priceExplanation');
        let total = document.getElementById('total');
        let txtPrice = document.getElementById('price');
        let subTotal = document.getElementById('subtotal');

        if(price > 0){
            exp.innerHTML = "<strong>" + guards + " </strong>&nbsp;" + document.getElementById('officeType').value + ss +" \n" +
                " for&nbsp;<strong> " + days + " </strong>&nbsp;" + "day"+ s +
                " @&nbsp;<strong> " + (timeToRealFloat(endTime)-timeToRealFloat(startTime)).toFixed(1) + "  </strong>&nbsp;hours a day<br>";
            document.getElementById('perHour').innerHTML = "<em class='text-secondary'>$" + (rate-0).toFixed(2) + "/Guard/Hr</em>";

            subTotal.innerHTML = "$" + price.toFixed(2);
            total.innerHTML = "$" + (price*1.15).toFixed(2);
            txtPrice.value = (price*1.15);
        }else{
            exp.innerHTML = '';
            total.innerHTML = '';
            document.getElementById('price').value = '';
        }


    }catch (e){

    }
};
const __collapseCallback = function (mutationList) {
    for (let mutation of mutationList){
        if(mutation.attributeName === 'class'){
            var inputs = mutation.target.getElementsByTagName('input');
            if(mutation.target.classList.contains('show')){
                for (let input of inputs){
                    if(input.type !== 'checkbox'){
                        let attr = document.createAttribute('required');
                        input.setAttributeNode(attr);
                    }

                }
            }else{
                for (let input of inputs){
                    input.removeAttribute('required');
                }
            }
        }
    }

};

const _collapseTwoCallback = function (mutationsList, observer) {
    for(let mutation of mutationsList){

        var target = mutation.target;
        var row = document.getElementById('rowDateOverview');
        if(mutation.attributeName === 'class' /*&& !document.getElementById('collapseOne').classList.contains('show')*/){
            if(!mutation.target.classList.contains('show')){
                row.innerHTML = "" +
                    "<label for=\"txtStartDate\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Date</label>\n" +
                    "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                                <div class=\"form-row\">\n" +
                    "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"txtStartDate\" name=\"startDate\" value=\"\" readonly>\n" +
                    "                                </div>\n" +
                    "                            </div>";

                document.getElementById('startDateInput').value = '';
                document.getElementById('endDateInput').value = '';
                document.getElementById('endDateInput').setAttributeNode(document.createAttribute('readonly'));
            }else{
                rowDateOverview.innerHTML = '';
                var col = document.createElement('div');
                col.classList.add('col');
                var startRow = document.createElement('div');
                startRow.classList.add('form-row');
                var endRow = document.createElement('div');
                endRow.classList.add('form-row');

                var lblStartDate = document.createElement('label');
                lblStartDate.setAttribute('for', 'lblStartDate');
                lblStartDate.classList.add('col-5', 'col-form-label', 'text-primary');
                lblStartDate.innerHTML = 'Start Date';
                startRow.appendChild(lblStartDate);
                var txtStartDate = document.createElement('input');
                txtStartDate.type = 'text';
                txtStartDate.classList.add('col-7', 'form-control-plaintext');
                txtStartDate.id = 'txtStartDate';
                txtStartDate.name = 'startDate';
                var readonly = document.createAttribute('readonly');
                txtStartDate.setAttributeNode(readonly);
                startRow.appendChild(txtStartDate);

                var lblEndDate = document.createElement('label');
                lblEndDate.setAttribute('for', 'lblEndDate');
                lblEndDate.classList.add('col-5', 'col-form-label', 'text-primary');
                lblEndDate.innerHTML = 'End Date';
                endRow.appendChild(lblEndDate);
                var txtEndDate = document.createElement('input');
                txtEndDate.type = 'text';
                txtEndDate.classList.add('col-7', 'form-control-plaintext');
                txtEndDate.id = 'txtEndDate';
                txtEndDate.name = 'endDate';
                var rreadonly = document.createAttribute('readonly');
                txtEndDate.setAttributeNode(rreadonly);
                endRow.appendChild(txtEndDate);

                col.appendChild(startRow);
                col.appendChild(endRow);
                row.appendChild(col);
            }
        }
    }
};
/*
const _collapseTooCallback = function (mutationsList, observer) {
    for(let mutation of mutationsList){

        var target = mutation.target;
        var row = document.getElementById('rowDateOverview');
        if(mutation.attributeName === 'class'){
            if(!mutation.target.classList.contains('show')){
                row.innerHTML = "<label for=\"startDate\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Date</label>\n" +
                    "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                                <div class=\"form-row\">\n" +
                    "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"startDate\" name=\"startDate\" value=\"\" readonly>\n" +
                    "                                </div>\n" +
                    "                            </div>";

                document.getElementById('selStartInput').value = '';
                document.getElementById('selEndInput').value = '';
                document.getElementById('collapseOne').classList.toggle('sam');
            }else{
                rowDateOverview.innerHTML = '';
                var col = document.createElement('div');
                col.classList.add('col');
                var dateRow = document.createElement('div');
                dateRow.classList.add('form-row');
                var startRow = document.createElement('div');
                startRow.classList.add('form-row');
                var endRow = document.createElement('div');
                endRow.classList.add('form-row');

                var lblDate = document.createElement('label');
                lblDate.setAttribute('for', 'lblDate');
                lblDate.classList.add('col-5', 'col-form-label', 'text-primary');
                lblDate.innerHTML = 'Date';
                lblDate.name = 'startDate';
                dateRow.appendChild(lblDate);
                var txtDate = document.createElement('input');
                txtDate.type = 'text';
                txtDate.classList.add('col-7', 'form-control-plaintext');
                txtDate.id = 'startDate';
                var rrreadonly = document.createAttribute('readonly');
                txtDate.setAttributeNode(rrreadonly);
                dateRow.appendChild(txtDate);

                var lblStartTime = document.createElement('label');
                lblStartTime.setAttribute('for', 'lblStartTime');
                lblStartTime.classList.add('col-5', 'col-form-label', 'text-primary');
                lblStartTime.innerHTML = 'Start Time';
                startRow.appendChild(lblStartTime);
                var txtStartTime = document.createElement('input');
                txtStartTime.type = 'text';
                txtStartTime.classList.add('col-7', 'form-control-plaintext');
                txtStartTime.id = 'txtStartTime';
                var readonly = document.createAttribute('readonly');
                txtStartTime.setAttributeNode(readonly);
                startRow.appendChild(txtStartTime);

                var lblEndTime = document.createElement('label');
                lblEndTime.setAttribute('for', 'lblEndTime');
                lblEndTime.classList.add('col-5', 'col-form-label', 'text-primary');
                lblEndTime.innerHTML = 'End Time';
                endRow.appendChild(lblEndTime);
                var txtEndTime = document.createElement('input');
                txtEndTime.type = 'text';
                txtEndTime.classList.add('col-7', 'form-control-plaintext');
                txtEndTime.id = 'txtEndTime';
                var rreadonly = document.createAttribute('readonly');
                txtEndTime.setAttributeNode(rreadonly);
                endRow.appendChild(txtEndTime);

                col.appendChild(dateRow);
                col.appendChild(startRow);
                col.appendChild(endRow);
                row.appendChild(col);
            }
        }
    }
};

const daysCallback = function (mutationsLst, observer) {
    for (let mutation of mutationsLst) {
        if (mutation.attributeName === 'class') {
            var sender = mutation.target;
            var row = document.getElementById('rowDateOverview');
            var inputs = document.getElementsByTagName('input');
            if (!sender.classList.contains('show')) {
                row.innerHTML = "<label for=\"startDate\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Date</label>\n" +
                    "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                                <div class=\"form-row\">\n" +
                    "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"startDate\" name=\"startDate\" value=\"\" readonly>\n" +
                    "                                </div>\n" +
                    "                            </div>";

                for (let input of inputs) {
                    input.checked = false;
                }

            } else if (sender.classList.contains('no-time-inputs')) {
                row.innerHTML = "<div class='col'>\n " +
                    "                <div class='form-row'>" +
                    "                    <label for=\"startDate\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Days</label>\n" +
                    "                    <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                        <input type='hidden' value='" + new Date() +"' >\n" +
                    "                    </div>\n" +
                    "                </div>\n" +
                    "            </div>";
            } else {
                row.innerHTML = "<div class='col'>\n " +
                    "                <div class='form-row'>" +
                    "                    <label for=\"startDate\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Days</label>\n" +
                    "                    <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                        <input type='hidden' value='" + new Date() +"' >\n" +
                    "                    </div>\n" +
                    "                </div>\n" +
                    "                <div class='form-row'>\n" +
                    "                    <label for=\"lblStartTime\" class=\"col-5 col-form-label text-primary\">Start Time</label>\n" +
                    "                    <input type=\"text\" class=\"col-7 form-control-plaintext\" id=\"txtStartTime\" readonly=\"\">\n" +
                    "                </div>\n " +
                    "                <div class=\"form-row\">\n" +
                    "                    <label for=\"lblEndTime\" class=\"col-5 col-form-label text-primary\">End Time</label>\n" +
                    "                    <input type=\"text\" class=\"col-7 form-control-plaintext\" id=\"txtEndTime\" readonly=\"\">\n" +
                    "                </div>\n" +
                    "            </div>\n " +
                    "                            ";
            }
        }
    }
};
*/
const setCallback = function (mutationList) {
    var row = document.getElementById('rowDateOverview');
    var heading = document.getElementById('lblDateHeading');
    var col = document.getElementById('ovDateCol');
    for (let mutation of mutationList){
        if(mutation.target.classList.contains('show')){
            var custom = document.getElementById('custom');
            var divs = custom.getElementsByClassName('collapse');
            for(let div of divs){
                if(div.classList.contains('show'))div.classList.remove("show");
            }

            try{
                heading.innerHTML = 'Date';
            }catch(typeError){

            }

            col.innerHTML = "<div class=\"form-row\">\n" +
            "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"txtStartDate\" name=\"startDate\" value=\"\" readonly>\n" +
            "                                </div>"

        }else{
            document.getElementById('txtStartTime').value = '';
            document.getElementById('txtEndTime').value = '';
            try{
                document.getElementById('txtStartDate').value = '';
            }catch (typeError){

            }

        }
    }
};

const observer = new MutationObserver(_collapseTwoCallback);
//const observerToo = new MutationObserver(_collapseTooCallback);
//const daysObserver = new MutationObserver(daysCallback);
const collapseObserver = new MutationObserver(__collapseCallback);
const setObserver = new MutationObserver(setCallback);

const config = {attributes:true};


/**
 * function timeToFloat
 * convert a time string (HH:mm) to float value (HH.mm)
 * @param hhmm
 * @returns {number}
 */
function timeToFloat(hhmm){
    var time = hhmm.split(':');
    var hour = parseFloat(time[0]);
    var min = parseFloat(time[1])/100;
    return hour+min;

}

/**
 * function timeToRealFloat
 * convert a time string (HH:mm) to real float value i.e. 6:30 = 6.5, not 6.3
 * @param hhmm
 * @returns {number}
 */
function timeToRealFloat(hhmm){
    var time = hhmm.split(':');
    var hour = parseFloat(time[0]);
    var min = parseFloat(time[1])/60;
    return hour+min;

}

/**
 * function getDateDifference
 * returns the difference between 2 dates in days;
 * @param date1
 * @param date2
 * @returns {number}
 */
function getDateDifference(date1, date2){
    return (date2-date1)/1000/60/60/24;
}
function updateTextInput(val) {
    document.getElementById('textInput').innerHTML=val;
}
function overviewTextInput(val) {
    document.getElementById('number1').value=val;
}
function overviewType(sender){
    var rate = sender.options[sender.selectedIndex].getAttribute('data-rate');
    document.getElementById('type').value=sender.value;
    document.getElementById('type').setAttribute('data-rate', rate);
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
    document.getElementById('txtStartDate').value =val;
}
function overviewStart(val){
    document.getElementById('txtStartTime').value =val;
}
function overviewEnd(val){
    document.getElementById('txtEndTime').value =val;
}
function overviewTitle(val){
    document.getElementById('txtTitle').value =val;
    document.getElementById('txtTitleDisplay').innerHTML =val;
}
function overviewPrice(val){
    document.getElementById('txtPrice').value ="$" + (val-0).toFixed(2);
    document.getElementById('price').value =val;
}
function overviewQuote(checked){
    var priceInput = document.getElementById('priceInput');
    var txtPrice = document.getElementById('txtPrice');
    var price = document.getElementById('price');
    if(checked){
        priceInput.value = '';
        priceInput.setAttributeNode(document.createAttribute('readonly'));
        txtPrice.value = 'Request a Quote';
        price.value = '';
    }else{
        priceInput.value = '';
        priceInput.removeAttribute('readonly');
        txtPrice.value = ''

    }
}

function calcPrice(rate, guards,date1,date2,startTime,endTime){
    return rate*(guards*((getDateDifference(date1,date2)+1)*(endTime-startTime)));

}

window.addEventListener('load', function () {

    try{
        observer.observe(document.getElementById('collapseTwo'), config);
    }catch (typeError) {

        //observerToo.observe(document.getElementById('collapseToo'), config);
    }

    try{
        daysObserver.observe(document.getElementById('collapseOne'), config);
    }catch (typeError) {

    }

    var collapses = document.getElementsByClassName('collapse-observe');

    for (let c of collapses){

        try{
            collapseObserver.observe(c, config);
        }catch(typeError){

        }
    }

    try{
        setObserver.observe(document.getElementById('collapseExample'), config);
    }catch(typeError){

    }
    /*
    document.getElementById('ongoingCheck').addEventListener('click', function (event) {
        var target = event.target;
        if(target.checked){
            document.getElementById('lblDateHeading').innerHTML = 'Days (Ongoing)';
        }else{
            document.getElementById('lblDateHeading').innerHTML = 'Days';
        }
    });
    */

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

    var overviewInputs = document.getElementsByTagName('input');

    for(var oInput of overviewInputs){
        oInput.addEventListener('change', priceCallback);
    }

    for (var sel of document.getElementsByTagName('select')){
        sel.addEventListener("change", priceCallback);
    }

    //Get Start time inputs using custom class name
    var startTimeInputs = document.getElementsByClassName('start-time-input');

    //loop through and add event listener to each
    for (var input of startTimeInputs){
        input.addEventListener('input', function (event) {
            var sender = event.target;
            var endTime = document.getElementById(sender.getAttribute('data-sibling'));

            endTime.setAttribute('min', sender.value);
            //check if start > end
            if(timeToFloat(sender.value) > timeToFloat(endTime.value)){
                endTime.value = sender.value;
                document.getElementById('txtEndTime').value = sender.value;
            }
        })
    }
    //Get End time inputs using custom class name
    var endTimeInputs = document.getElementsByClassName('end-time-input');

    //loop through and add event listener to each
    for (var inputt of endTimeInputs){
        inputt.addEventListener('input', function (event) {
            var sender = event.target;
            var startTime = document.getElementById(sender.getAttribute('data-sibling'));

            //check if end > start
            if(timeToFloat(sender.value) < timeToFloat(startTime.value)){
                sender.value = startTime.value;
                document.getElementById('txtEndTime').value = sender.value;
            }
        })
    }

    /*
     * Update the overview when the days are checked
     */
    var dayChecks = document.getElementsByClassName('day-check');
    for (var check of dayChecks){
        check.addEventListener('click', function (event) {
            var id = 'day' + event.target.getAttribute('data-info');
            var daysOverview = document.getElementById('ovDateCol');
            if (event.target.checked){
                var row = document.createElement('div');
                row.classList.add('form-row', 'w-100');
                row.id = id;
                var input = document.createElement('input');
                input.classList.add('form-control-plaintext');

                input.setAttribute('type', 'text');
                input.setAttribute('name', 'days[]');
                input.value = event.target.getAttribute('data-info');
                row.appendChild(input);
                daysOverview.appendChild(row);
            }else{
                rem = document.getElementById(id);
                daysOverview.removeChild(rem);
            }

        });
    }

    /*
     * Update address overview with client address info and disable manual address input when checkbox is checked
     */
    document.getElementById('gridCheck').addEventListener('click', function (event) {
        var sender = event.target;
        var ovStreet = document.getElementById('street');
        var ovSuburb = document.getElementById('suburb');
        var ovCity = document.getElementById('city1');
        var ovPostcode = document.getElementById('postcode1');
        var addressInputs = document.getElementsByClassName('address-input');
        if(sender.checked){
            var street = sender.getAttribute('data-street');
            var suburb = sender.getAttribute('data-suburb');
            var city = sender.getAttribute('data-city');
            var postcode = sender.getAttribute('data-postcode');

            ovStreet.value = street;
            ovSuburb.value = suburb;
            ovCity.value = city;
            ovPostcode.value = postcode;

            for (input of addressInputs){
                input.classList.add('f-readonly');
                input.value = sender.getAttribute("data-" + input.getAttribute('data-input'));
            }
        }else{
            ovStreet.value = '';
            ovSuburb.value = '';
            ovCity.value = '';
            ovPostcode.value = '';
            for (input of addressInputs){
                input.value = '';
                input.classList.remove('f-readonly');
            }
        }

    });
    try{

        //Check start date, update start date overview and ensure end date is valid
        document.getElementById('startDateInput').addEventListener('input', function (event) {
            var sender = event.target;
            var endDateInput = document.getElementById('endDateInput');
            var txtStartDate = document.getElementById('txtStartDate');
            var txtEndDate = document.getElementById('txtEndDate');
            try{
                endDateInput.removeAttribute('readonly');
                endDateInput.setAttribute('min', sender.value);
                if(new Date(endDateInput.value) < new Date(sender.value)){
                    endDateInput.value = sender.value;
                    txtEndDate.value = sender.value;
                }
            }catch(e){

            }

            txtStartDate.value = sender.value;

        });
        //Update end date overview when end date input is changed
        document.getElementById('endDateInput').addEventListener('input', function (event) {
            var sender = event.target;
            var txtEndDate = document.getElementById('txtEndDate');

            txtEndDate.value = sender.value;

        });


    }catch (typeError) {

    }

});
