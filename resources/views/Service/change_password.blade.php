@extends('Profile.layout')

@section('mainContent')
    <div class="col d-flex justify-content-center">
        <div class="card border-primary mb-3" style="width: 800px">
            <div class="card-header">Change Password</div>
            <div class="card-body">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">X</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                <form method="post" action="{{route('service.password.change')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="current_password" class="col-md-4 col-form-label text-md-right">Current Password:</label>
                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control" name="current_password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password:</label>
                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm New Password:</label>
                        <div class="col-md-6">
                            <input id="confirm_password" type="password" class="form-control" name="new_password_confirmation" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Change Password</button>
                </form>
            </div>
        </div>
    </div>



@endsection
