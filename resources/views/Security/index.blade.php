@extends('Security.layout')
@section('pageTitle','My Profile ')
@section('mainContent')
    <!--TODO find a way to update Session page data depending on what page is accessed-->

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

@endsection

