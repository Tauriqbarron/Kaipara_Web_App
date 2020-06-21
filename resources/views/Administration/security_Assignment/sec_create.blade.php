@extends('Administration.layout')
@section('mainContent')
    <div class="w-75 mx-auto bg-light p-2 mt-2 rounded">
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif
    <h1 class="ml-5">Create security assignment</h1>
    <hr/>

    <form class="ml-2" method="post" action="{{route('security_assignment.create')}}" >
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client_id">Client ID:</label>
                <input name="client_id" class="form-control @error('client_id') is-invalid @enderror" placeholder="Client ID" value="{{old('client_id')}}">
                @error('client_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="booking_type">Assignment type:</label>
                <select class="form-control" name="booking_type">
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="price">Price:</label>
                <input class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter a price" value="{{old('price')}}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{old('description')}}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Start Date:</label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" placeholder="YY-mm-dd" value="{{old('date')}}">
                @error('date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="date">End date:</label>
                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="YY-mm-dd" value="{{old('end_date')}}">
                @error('end_date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="start_time">Start Time:</label>
                <input type="text" name="start_time" class="form-control" placeholder="default: 9.30" value="{{old('start_time')}}">
            </div>
            <div class="form-group col-md-6">
                <label for="finish_time">End Time:</label>
                <input type="text" name="finish_time" class="form-control" placeholder="default: 16.30" value="{{old('finish_time')}}">
            </div>

            <div class="form-group">
                <label for="numOfStaff">Number of Officer:</label>
                <select class="form-control" name="numOfStaff">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
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
        <a type="button" class="btn btn-danger" href="{{route('security_assignment.index')}}">Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
    </div>
@endsection
