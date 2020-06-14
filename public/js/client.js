//Client Specific functions
const _collapseTwoCallback = function (mutationsList, observer) {
    for(let mutation of mutationsList){

        var target = mutation.target;
        var row = document.getElementById('rowDateOverview');
        if(mutation.attributeName === 'class'){
            if(!mutation.target.classList.contains('show')){
                row.innerHTML = "<label for=\"date1\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Date</label>\n" +
                    "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                                <div class=\"form-row\">\n" +
                    "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"date1\" name=\"date1\" value=\"\" readonly>\n" +
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

const _collapseTooCallback = function (mutationsList, observer) {
    for(let mutation of mutationsList){

        var target = mutation.target;
        var row = document.getElementById('rowDateOverview');
        if(mutation.attributeName === 'class'){
            if(!mutation.target.classList.contains('show')){
                row.innerHTML = "<label for=\"date1\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Date</label>\n" +
                    "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
                    "                                <div class=\"form-row\">\n" +
                    "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"date1\" name=\"date1\" value=\"\" readonly>\n" +
                    "                                </div>\n" +
                    "                            </div>";

                document.getElementById('selStartInput').value = '';
                document.getElementById('selEndInput').value = '';
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
                dateRow.appendChild(lblDate);
                var txtDate = document.createElement('input');
                txtDate.type = 'text';
                txtDate.classList.add('col-7', 'form-control-plaintext');
                txtDate.id = 'date1';
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
  for(let mutation of mutationsLst){
      var sender = mutation.target;
      var row = document.getElementById('rowDateOverview')
      if(!sender.classList.contains('show')){
          row.innerHTML = "<label for=\"date1\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Date</label>\n" +
              "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
              "                                <div class=\"form-row\">\n" +
              "                                    <input type=\"text\" class=\"col-7 form-control-plaintext \" id=\"date1\" name=\"date1\" value=\"\" readonly>\n" +
              "                                </div>\n" +
              "                            </div>";

      }else{
          row.innerHTML = "<label for=\"date1\" id=\"lblDateHeading\" class=\"col-5  col-form-label text-primary\">Days</label>\n" +
              "                            <div id=\"ovDateCol\" class=\"col-7\">\n" +
              "                            </div>";

      }
  }
};

const observer = new MutationObserver(_collapseTwoCallback);
const observerToo = new MutationObserver(_collapseTooCallback);
const daysObserver = new MutationObserver(daysCallback);

const config = {attributes:true};

function timeToFloat(hhmm){
    var time = hhmm.split(':');
    var hour = parseFloat(time[0]);
    var min = parseFloat(time[1])/100;
    return hour+min;

}

window.addEventListener('load', function () {

    //TODO
    // - add event listener to startTime inputs to prevent start time being larger than end time.
    // - do something about select days

    try{
        observer.observe(document.getElementById('collapseTwo'), config);
    }catch (typeError) {

    }

    try{
        observerToo.observe(document.getElementById('collapseToo'), config);
    }catch (typeError) {

    }

    try{
        daysObserver.observe(document.getElementById('collapseOne'), config);
    }catch (typeError) {

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
                document.getElementById('endTime').value = sender.value;
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

            //check if end > end
            if(timeToFloat(sender.value) < timeToFloat(startTime.value)){
                sender.value = startTime.value;
                document.getElementById('endTime').value = sender.value;
            }
        })
    }

    /**
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

    /**
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
                attr = document.createAttribute('readonly');
                input.value = '';
                input.setAttributeNode(attr);
            }
        }else{
            ovStreet.value = '';
            ovSuburb.value = '';
            ovCity.value = '';
            ovPostcode.value = '';
            for (input of addressInputs){
                input.value = '';
                input.removeAttribute('readonly');
            }
        }

    });

    //Check start date, update start date overview and ensure end date is valid
    document.getElementById('startDateInput').addEventListener('input', function (event) {
        var sender = event.target;
        var endDateInput = document.getElementById('endDateInput');
        var txtStartDate = document.getElementById('txtStartDate');
        var txtEndDate = document.getElementById('txtEndDate');

        endDateInput.removeAttribute('readonly');
        endDateInput.setAttribute('min', sender.value);
        if(new Date(endDateInput.value) < new Date(sender.value)){
            endDateInput.value = sender.value;
            txtEndDate.value = sender.value;
        }
        txtStartDate.value = sender.value;

    });
    //Update end date overview when end date input is changed
    document.getElementById('endDateInput').addEventListener('input', function (event) {
        var sender = event.target;
        var txtEndDate = document.getElementById('txtEndDate');

        txtEndDate.value = sender.value;

    });



});
