/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const url = '/tasks';
const $app = $('#app');
const $calendar = $('#calendar');

const getTasksByDate = (date) => {

    $('#task-date').text(date);

    $.ajax({
        method: 'GET',
        url: url + '/' + date
    })
        .done((data) => {
            $('#tasks').html(data);
        })
        .fail(() => {
            $('#tasks').html('Some Error');
        });
};

const showTask = (task) => {
    const {id, title, status, user, date} = task;
    $('#task-id').val(id);
    $('#title').val(title);
    $('#status').val(status);
    $('#user_id').val(user.id);
    $('#date').val(date);

    $('#btn-save').val('update');

    $('#myModal').modal('show');
};


//display modal form for task editing
$app.on('click', '#edit-task', function () {
    const taskId = $(this).val();

    $.ajax({
        method: 'GET',
        url: url + '/' + taskId
    })
        .done((task) => {
            showTask(task)
        })
        .fail((error) => {
            console.log('Error:', error);
        });
});

//display modal form for creating new task
$app.on('click', '#add-task', function () {
    const date = $(this).data('date');
    $('#date').attr('value', date);

    $('#btn-save').val('add');
    $('#task-form').trigger('reset');

    $('#myModal').modal('show');
});

//delete task and remove it from list
$app.on('click', '#delete-task', function () {
    const taskId = $(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'DELETE',
        url: url + '/' + taskId
    })
        .done((data) => {
            $("#task" + taskId).remove();
            $calendar.fullCalendar('removeEvents', taskId)
        })
        .fail((error) => {
            console.log('Error:', error.responseText);
        });
});

//create new task / update existing task
$app.on('click', '#btn-save', function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    e.preventDefault();

    const formData = {
        title: $('#title').val(),
        status: $('#status').val(),
        user_id: $('#user_id').val(),
        date: $('#date').val()
    };

    //used to determine the http verb to use [add=POST], [update=PUT]
    const state = $('#btn-save').val();
    let type, ajaxUrl;

    if (state === 'add') {
        type = 'POST'; //for creating new resource
        ajaxUrl = url;
    }

    if (state === 'update') {
        type = 'PUT'; //for updating existing resource
        const taskId = $('#task-id').val();
        ajaxUrl = url + '/' + taskId;

    }

    $.ajax({
        method: type,
        url: ajaxUrl,
        data: formData
    })
        .done((data) => {

            $('#frmTasks').trigger("reset");
            $('#myModal').modal('hide');

            getTasksByDate(formData.date);

            $calendar.fullCalendar('refetchEvents');
        })
        .fail((error) => {
            const errors = error.responseJSON;
            $('.form-group').removeClass('has-error');
            for (let key in errors) {
                $('#' + key).closest('.form-group').addClass('has-error');
            }
        });

});


/* Full Calendar */

$calendar.fullCalendar({
    events: {
        url: '/tasks',
        className: 'calendar__task'
    },
    eventRender: (event, element) => {
        if (event.status === 'Done') {
            element.addClass('task__done');
        };
        if (event.status === 'Recycled') {
            element.addClass('task__recycled');
        }
    },
    dayClick: (date, jsEvent, view) => {

        getTasksByDate(date.format());

    },
    eventClick: (event, jsEvent, view) => {

        showTask(event);

    },
    selectable: true,
    unselectAuto: false
});


