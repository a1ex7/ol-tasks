<ul class="list-unstyled">
@forelse($tasks as $task)
    <li id="task{{$task->id}}">
        <blockquote>
            <p>{{ $task->title }} ({{ $task->status }})</p>
            <footer>{{ $task->user->name }}</footer>
            <button class="btn btn-warning btn-xs open-modal" id="edit-task" value="{{$task->id}}">Edit</button>
            <button class="btn btn-danger btn-xs" id="delete-task" value="{{$task->id}}">Delete</button>
        </blockquote>
    </li>
@empty
    <li><p>No tasks</p></li>
@endforelse
</ul>
<button class="btn btn-primary open-modal" id="add-task" data-date="{{ $date }}">
    <span class="glyphicon glyphicon-plus"></span>
    Add Task for {{ $date }}
</button>
