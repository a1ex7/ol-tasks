@extends('templates.modal')

@section('modal-body')
    {{ Form::open(['route' => 'tasks.store', 'class' => 'form-horizontal', 'id' => 'task-form']) }}

    <div class="form-group">
        {{ Form::label('title', 'Task title:', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-8">
            {{ Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Enter the task']) }}
            <span class="help-block hidden" id="error-title">
                <strong>Error</strong>
            </span>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('status', 'Status:', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-8">
            {{ Form::select('status', array_combine($statuses, $statuses), $statuses[0], ['class' => 'form-control']) }}
        </div>
        <span class="help-block hidden" id="error-status">
            <strong>Error</strong>
        </span>
    </div>

    <div class="form-group">
        {{ Form::label('user_id', 'User:', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-8">
            {{ Form::select('user_id', $users, old('user_id'), ['class' => 'form-control', 'placeholder' => 'Assigned user']) }}
        </div>
        <span class="help-block hidden" id="error-user_id">
            <strong>Error</strong>
        </span>
    </div>

    <div class="form-group">
        {{ Form::label('date', 'Task date:', ['class' => 'col-md-2 control-label']) }}
        <div class="col-md-8">
            {{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
        </div>
        <span class="help-block hidden" id="error-date">
            <strong>Error</strong>
        </span>
    </div>

    {{ Form::close() }}
@endsection

@section('modal-footer')
    <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
    <input type="hidden" id="task-id" name="task-id" value="0">
@endsection