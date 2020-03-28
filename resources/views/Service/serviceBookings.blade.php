@extends('Service.serviceProfileTemplate')


@section('mainContent')
    <div class="bookCon">
        <div name="appMap">
            /*map style Interface with available jobs marked */
        </div>
        <div class="jobList">
            <div class="jobListCon">
                <div class="card w-auto">
                    <div class="card-body">
                        <img src="https://www.zones.co.nz/images/uploads/panoramas/mid-range-fence-pano-4.jpg" class="card-img-top" alt="...">
                        <h5 class="card-title">Card title</h5>
                        <h5 class="card-title">Price</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary float-right mx-1">Accept</a>
                        <a href="#" class="btn btn-primary float-right mx-1">Decline</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
