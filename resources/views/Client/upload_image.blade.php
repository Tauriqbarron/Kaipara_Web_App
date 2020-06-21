@extends('Profile.layout')

@section('mainContent')
    <div class="container">
        <div class="col">
            <form method="post"  action="{{route('client.postUploadImage')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row align-self-center">
                    <div class="col"></div>
                    <div class="col rounded bg-light p-3 shadow-sm">
                       <input type="file" class="form-control-file" id="img" name="image" placeholder="Select your photo" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg" >
                       <input type="submit" class="btn btn-primary my-2" value="Upload">
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
