@extends('Administration.layout')

@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        <h1 class="ml-5">Create property service assignment</h1>
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif
        <hr/>

        <form class="ml-2" method="post" action="{{route('admin.service.create')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="client_id">Client ID</label>
                    <input type="text" name="client_id" class="form-control @error('client_id') is-invalid @enderror" placeholder="Client ID" value="{{old('client_id')}}">
                    @error('client_id')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{old('title')}}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Job type:</label>
                    <select class="form-control" name="job_type">
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->description}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group w-25">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price" placeholder="Price, can be entered later" value="{{old('price')}}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" name="description" rows="3">{{old('description')}}
                </textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Start Date (Start date must after today):</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{old('date')}}">
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="street">Street:</label>
                <input name="street" class="form-control @error('street') is-invalid @enderror" placeholder="Street" value="{{old('street')}}" />
                @error('street')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="suburb">Suburb:</label>
                    <input name="suburb" class="form-control @error('suburb') is-invalid @enderror" placeholder="Suburb" value="{{old('suburb')}}" />
                    @error('suburb')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="city">City:</label>
                    <input name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{old('city')}}" />
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="postcode">Zip:</label>
                    <input name="postcode" class="form-control @error('postcode') is-invalid @enderror" placeholder="Postcode" value="{{old('postcode')}}" />
                    @error('postcode')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <a type="button" class="btn btn-danger" href="{{URL::previous()}}">Back</a>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>



@endsection
