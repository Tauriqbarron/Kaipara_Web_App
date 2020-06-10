@extends('Security.layout')
@section('pageTitle','My Profile ')
@section('mainContent')

    <div class="page-toggle-page" id="profileContainer" style="display: none">
        @include('Security.profile')
    </div>
    <div class="page-toggle-page" id="rosterContainer" style="display: none">
        @include('Security.roster')
    </div>
    <div class="page-toggle-page" id="scheduleContainer" style="display: none">
        @include('Security.schedule')
    </div>
    <div class="page-toggle-page" id="assignmentContainer" style="display: none">
        @include('Security.assignments')
    </div>
    <div class="page-toggle-page" id="settingsContainer" style="display: none">
        @include('Security.settings')
    </div>
    <script type="text/javascript">
        loaded()
    </script>

@endsection
