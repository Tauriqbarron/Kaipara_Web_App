@extends('Security.layout')
@section('pageTitle','My Profile ')
@section('mainContent')

    <div id="profileContainer" style="display: none">
        @include('Security.profile')
    </div>
    <div id="rosterContainer" style="display: none">
        @include('Security.roster')
    </div>
    <div id="scheduleContainer" style="display: none">
        @include('Security.schedule')
    </div>
    <div id="assignmentContainer" style="display: none">
        @include('Security.assignments')
    </div>
    <script type="text/javascript">
        loaded()
    </script>

@endsection

