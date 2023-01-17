<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Http\Requests\TasksRequest;
use App\Http\Resources\TasksResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TasksResource::collection(Tasks::orderBy('created_at', 'asc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TasksRequest $request)
    {
        $data = $request->validated();
        $task = Tasks::create($data);

        return response(new TasksResource($task), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return response("", 200);
    }
}
