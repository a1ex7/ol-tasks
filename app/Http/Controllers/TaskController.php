<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource by bate.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByDate($date)
    {
        $tasks = Task::where('date', '=', $date)->with('user')->get();

        return view('templates.tasks')->with(compact('tasks', 'date'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('user')->get();

        return Response::json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->all());
        return Response::json($task);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Task $task
     */
    public function show($id)
    {
        $task = Task::with('user')->find($id);

        return Response::json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        $task->fill($request->all());
        $task->update();

        return Response::json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return Response::json('Task '.$task->id.' deleted');
    }
}
