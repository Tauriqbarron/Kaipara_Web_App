@extends('Administration.layout')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@section('mainContent')

    <!--The calendar-->
    <div class="text-center">
    <h1 class="">staff name: {{$staff->first_name}} {{$staff->last_name}}
    </h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example">Add Roster</button>
    </div>
    <hr/>
    <div class="form-row justify-content-center">
        <div class="form-group mr-2">

        </div>
        <div class="form-group w-50">
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>

    <!--Add new roster form in modal-->
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

    <!--Roster record-->
    <div class="text-center">
    <button type="button" class="btn btn-success" id="showRecord">Show roster record</button>
    <hr/>
    </div>

    <table class="table" id="rosterRecord">
        <thead>
        <tr>
            <th>
                Staff Name: {{$staff->first_name}}
                {{$staff->last_name}}
            </th>
            <th>Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($rosters as $record)
            <tr>
                <td></td>
                <td>
                    {{$record->date}}
                </td>
                <td>
                    <a class="btn btn-primary" href="#">Edit</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="#">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!--Show and hide record table-->
    <script>
        $(document).ready(function () {
            $('#rosterRecord').hide();
        });

            $('#showRecord').click(function () {
                $('#rosterRecord').toggle(500, 'linear');

            });
    </script>

@endsection
