@extends('Administration.layout')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@section('mainContent')
    <h1>staff id: {{$staff->id}}</h1>
    <form class="form-row">
        <div class="form-group w-50">
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
        <div class="form-group col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example">test</button>
        </div>
    </form>


    <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Roster</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('staff.roster', ['id' => $staff->id])}}">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label><strong>Staff name: </strong></label>
                            {{$staff->first_name}}
                            {{$staff->last_name}}
                        </div>
                        <div class="form-group" id="date">
                            <label for="date"><strong>Date: </strong></label>
                            <input type="date" class="form-control" name="date">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
