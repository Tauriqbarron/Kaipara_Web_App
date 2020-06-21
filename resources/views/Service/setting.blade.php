@extends('Profile.layout')

@section('mainContent')
    <div class="profile-card-col" style="min-height: 670px">
        <div  class="profile-id-card card bg-light shadow p-3 mb-2 border-0 card-image float-none rounded-lg shadow col-sm-0" style="background-image: url({{url('images/Card_BG.jpg')}}); ">
            <div id="cardHeader" class="card-header bg-light border-0 rounded">
                <img class="w-100 align-top" src="{{url('images/Card_Header.png')}}" alt="Card top">
            </div>
            <img id="card-img-top" class="card-img-top rounded-circle border-light shadow border-3 mr-auto ml-auto mb-auto" src="{{isset(Auth()->guard('service_provider')->user()->imgPath) ? url(Auth()->guard('service_provider')->user()->imgPath) : url('images/Profile_Placeholder_Large.png')}}" alt="Card image cap">
            <a href="{{route('service.getUploadImage')}}" title="Change Profile Picture"><span class="fa fa-pencil position-relative" style="bottom:30px; left: 120px;"></span></a>
            <div class="mt-4 card-body text-light">
                <h5 class="card-title text-center">{{Auth()->guard('service_provider')->user()->firstname}} {{Auth()->guard('service_provider')->user()->lastname}}</h5>
                <h5 class="card-title text-center">Ph: {{Auth()->guard('service_provider')->user()->phone_number}}</h5>
                <h5 class="card-title text-center">ID#: {{Auth()->guard('service_provider')->user()->id}}</h5>

            </div>

            <div class="card-footer bg-dark rounded">
                <img class="w-100 align-top" src="{{url('images/KaiparaLogo.png')}}" alt="Card top">
            </div>
        </div>

    </div>
    <div style="width:74%; float: left; padding-left: 20px">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-center">Your Information</h2>
        <div class="container py-3 px-4 jumbotron bg-light" id="schedule">
            <form method="POST" action="{{route('service.postEdit')}}" class="needs-validation">
                @csrf
                <div class="row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>ID#:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" class="form-control-plaintext" value="{{Auth()->guard('service_provider')->user()->id}}" readonly>
                        </label>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>First Name:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" class="form-control-plaintext" value="{{Auth()->guard('service_provider')->user()->firstname}}" readonly>
                        </label>
                    </div>
                    <div class="col-1">

                    </div>
                </div>
                <div class="row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>Last Name:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" class="form-control-plaintext" value="{{Auth()->guard('service_provider')->user()->lastname}}" readonly>
                        </label>
                    </div>
                    <div class="col-1">

                    </div>
                </div>
                <div class="row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-9">
                        <label>
                            <input type="text" class="form-control-plaintext" value="{{Auth()->guard('service_provider')->user()->email}}" readonly>
                        </label>
                    </div>
                    <div class="col-1">

                    </div>
                </div>
                <div class="row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>Phone Number:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" id="editPhoneNumber" name="phone_number" class="form-control form-control-plaintext can-edit" value="{{Auth()->guard('service_provider')->user()->phone_number}}" readonly required>
                        </label>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-pencil text-secondary edit-toggle" data-target="editPhoneNumber" title="edit"></i>
                    </div>
                </div>
                <div class="row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>Street:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" id="editStreet" name="street" class="form-control form-control-plaintext can-edit" value="{{Auth()->guard('service_provider')->user()->street}}" readonly required>
                        </label>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-pencil text-secondary edit-toggle" data-target="editStreet" title="edit"></i>
                    </div>
                </div>
                <div class=" row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>Suburb:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" id="editSuburb" name="suburb" class="form-control form-control-plaintext can-edit" value="{{Auth()->guard('service_provider')->user()->suburb}}" readonly required>
                        </label>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-pencil text-secondary edit-toggle" data-target="editSuburb" title="edit"></i>
                    </div>
                </div>
                <div class=" row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>City:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" id="editCity" name="city" class="form-control form-control-plaintext can-edit" value="{{Auth()->guard('service_provider')->user()->city}}" readonly required>
                        </label>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-pencil text-secondary edit-toggle" data-target="editCity" title="edit"></i>

                    </div>
                </div>
                <div class=" row  border-bottom">
                    <div class="py-2 col-3">
                        <strong>Postcode:</strong>
                    </div>
                    <div class="col-8">
                        <label>
                            <input type="text" pattern="\d*" id="editPostCode" name="postcode" class="form-control form-control-plaintext can-edit" minlength="4" maxlength="4" value="{{Auth()->guard('service_provider')->user()->postcode}}" readonly required>
                        </label>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-pencil text-secondary edit-toggle" data-target="editPostCode" title="edit"></i>
                    </div>
                </div>
                <div class="mt-2 row w-100">
                    <div class="col-3">
                        <a href="{{route('service.password.change')}}">Change your password</a>
                    </div>
                    <div class="col-9">
                        <input type="submit" id="btnEditStaff" class="btn btn-success disabled float-right" value="Save Changes" style="pointer-events: none">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('load', function() {
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
    </script>

@endsection
