//Client Specific functions

window.addEventListener('load', function () {

    var dayChecks = document.getElementsByClassName('day-check');
    for (var check of dayChecks){
        check.addEventListener('click', function (event) {
            var id = 'day' + event.target.getAttribute('data-info');
            var daysOverview = document.getElementById('daysOverview');
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

});
