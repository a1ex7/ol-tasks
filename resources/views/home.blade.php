@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" >
                <h2>Calendar</h2>
                <div id="calendar"></div>
            </div>
            <div class="col-md-6">
                <h2>Tasks <small id="task-date"></small></h2>
                <div class="tasks" id="tasks"></div>
            </div>
        </div>
    </div>

    @include('templates.addform')

@endsection
